<?php

namespace Payment\Helper;

use Payment\Entity\Transaction;

/**
 * Class NotificationHelper
 * Functions useful to process notifications
 *
 * @package Payment\Helper
 * @author Lucile Gentner
 */

class NotificationHelper
{

    public static function processNotification($files, $entityManager){

        //HTML to be sent to the view
        $result = "";

        if ($files["notificationsJSON"]["error"] > 0) { //Error while uploading the file
            $result.='<p class="text-danger">ERROR while uploading the file '.$files["notificationsJSON"]["error"].'</span></p>';
        }

        else {

            $filename = $files["notificationsJSON"]["tmp_name"];
            $handle = fopen($filename, "r");

            if ($handle) {
                while (($line = fgets($handle)) !== false) { //Read each line


                    //Get line data
                    $notification = json_decode($line);

                    if (isset($notification->transaction_id) === true && isset($notification->status) === true && isset($notification->date) === true
                        && $notification->transaction_id !== NULL && $notification->status !== NULL && $notification->date !== NULL
                        && trim($notification->transaction_id) !== "" && trim($notification->status) !== "" && trim($notification->date) !== "") {

                        $transaction_id = $notification->transaction_id;
                        $status = $notification->status;
                        $date = new \DateTime($notification->date);

                        //Check if this transaction already exists in DB

                        $transactionDB = $entityManager->getRepository('Payment\Entity\Transaction')->findBy(array('transactionId' => $transaction_id));

                        if (!empty($transactionDB)) {
                            //If transaction already exists in DB
                            $transactionDB = current($transactionDB);

                            //Check if new status is different from the old one
                            if ($transactionDB->getStatus() === $status) {
                                $result.='<p class="text-danger">' . $transaction_id.' - '.$status.' - '.date_format($date, 'Y-m-d H:i:s') . ' : ERROR Status unchanged</span></p>';
                                continue;
                            }

                            //Check if (oldstatus, newstatus) couple exists in status_transition table

                            $statusTransition = $entityManager
                                ->getRepository('Payment\Entity\StatusTransition')
                                ->findBy(array('fromStatus' => $transactionDB->getStatus(), 'toStatus' => $status));

                            if (!empty($statusTransition)) {
                                //Transition authorized so we can update the transaction
                                $transactionDB->setStatus(intval($status));

                                //Check what date field should be updated
                                $statusDB = $entityManager
                                    ->getRepository('Payment\Entity\Status')
                                    ->findBy(array('id' => $status));

                                if (!empty($statusDB)) {

                                    $statusDB = current($statusDB);

                                    $dateToUpdate = $statusDB->getDateToUpdate();

                                    if ($dateToUpdate !== NULL) {
                                        $transactionDB->{"set" . ucwords($dateToUpdate)}($date);
                                    }
                                }

                                //Also set dateUpdated
                                $transactionDB->setDateUpdate($date);

                                $entityManager->persist($transactionDB);
                                $entityManager->flush();
                                $result.='<p>' . $transaction_id.' - '.$status.' - '.date_format($date, 'Y-m-d H:i:s') . ' : SUCCESS Update done</span></p>';

                                unset($statusTransition);
                                unset($transactionDB);
                            } else {

                                //Unauthorized transition
                                $result.='<p class="text-danger">' . $transaction_id.' - '.$status.' - '.date_format($date, 'Y-m-d H:i:s') . ' : ERROR Unauthorized transition</span></p>';
                                continue;
                            }


                        } else { //New transaction

                            //Check if s†atus exists in reference table
                            $statusDB = $entityManager
                                ->getRepository('Payment\Entity\Status')
                                ->findBy(array('id' => $status));


                            if (!empty($statusDB)) {

                                $statusDB = current($statusDB);

                                //Insert new transaction in DB
                                $newTransactionDB = new Transaction();
                                $newTransactionDB->setTransactionId($transaction_id);
                                $newTransactionDB->setStatus($status);
                                $newTransactionDB->setDateCreate($date);
                                $dateToUpdate = $statusDB->getDateToUpdate();

                                //Also update date according to status
                                if ($dateToUpdate !== NULL) {
                                    $newTransactionDB->{"set" . ucwords($dateToUpdate)}($date);
                                }

                                $entityManager->persist($newTransactionDB);
                                $entityManager->flush();


                                $result.='<p>' . $transaction_id.' - '.$status.' - '.date_format($date, 'Y-m-d H:i:s') . ' : SUCCESS Insert done</span></p>';
                            } else {
                                //Unknown Status
                                $result.='<p class="text-danger">' . $transaction_id.' - '.$status.' - '.date_format($date, 'Y-m-d H:i:s') . ' : ERROR Unknown status</span></p>';

                            }
                            continue;

                        }

                    } else {
                        //Unreadable data
                        $result.='<p class="text-danger">' . $line . ' : ERROR Unreadable data</span></p>';
                    }

                    unset($transaction_id, $status, $date);
                }

                //Stop reading the file
                fclose($handle);
                $result.='<p>END OF FILE</p>';
            } else {
                // error while opening the file
                $result.='<p class="text-danger">ERROR while opening the file</span></p>';
            }
        }

        return $result;
    }
}
