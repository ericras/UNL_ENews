<?php
class UNL_ENews_Newsroom_Newsletters extends UNL_ENews_NewsletterList
{
    function __construct($options = array())
    {
        if (!isset($options['newsroom_id'])) {
            $newsroom_id = UNL_ENews_Controller::getUser(true)->newsroom->id;
        } else {
            $newsroom_id = $options['newsroom_id'];
        }
        $letters = array();
        $mysqli = UNL_ENews_Controller::getDB();
        $sql = 'SELECT id FROM newsletters ';
        $sql .= 'WHERE newsroom_id = '. $newsroom_id .
                ' ORDER BY release_date DESC;';
        if ($result = $mysqli->query($sql)) {
            while($row = $result->fetch_array(MYSQLI_NUM)) {
                $letters[] = $row[0];
            }
        }
        $mysqli->close();
        parent::__construct($letters);
    }
}