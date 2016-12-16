<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_update_users_column extends CI_Migration {

    public function up()
    {
        $this->dbforge->drop_column('users', 'user_name');
        $this->dbforge->drop_column('users', 'user_email');
        $this->dbforge->drop_column('users', 'user_phone');


        $fields = array(
                'user_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'user_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'user_phone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                    'null' => TRUE,
                ),
                'user_token' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '40',
                    'null' => TRUE,
                ),
                'user_status' => array(
                    'type' => 'ENUM("not_yet_activated","activated","banned","deactivated")',
                    'default' => 'not_yet_activated',
                    'null' => false,
                ),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down()
    {

        $this->dbforge->drop_column('users', 'user_name');
        $this->dbforge->drop_column('users', 'user_email');
        $this->dbforge->drop_column('users', 'user_phone');
        $this->dbforge->drop_column('users', 'user_token');
        $this->dbforge->drop_column('users', 'user_status');
        $fields =  array(
                'user_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'user_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'user_phone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                ),
        );
            $this->dbforge->add_column('users',$fields);
    }

}