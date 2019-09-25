<?php
    class CounterUsersController extends AppController {
        var $name = 'CounterUsers';

        function countUserOnline() {
            $count_user_online = 0;
            $now = time();
            $time_out = 120;
            $list = $this->CounterUser->find('all');
            foreach($list as $user){
                if(strtotime($user['CounterUser']['last_visit']) + $time_out > $now) $count_user_online++;
            }
            return $count_user_online * 3;
        }

        function countUserInDay() {
            $count_user_in_day = $this->CounterUser->find(
                'count',
                array(
                    'fields' => 'id',
                    'conditions' => array('DAY(last_visit)' => date('d'), 'YEAR(last_visit)' => date('Y')),
                )
            );
            return $count_user_in_day * 3;
        }

        function countUserInMonth() {
            $count_user_in_month = $this->CounterUser->find(
                'count',
                array(
                    'fields' => 'id',
                    'conditions' => array('MONTH(last_visit)' => date('m'), 'YEAR(last_visit)' => date('Y')),
                )
            );
            return $count_user_in_month * 3;
        }
    }
?>