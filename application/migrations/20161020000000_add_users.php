<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_add_users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
                'user_id' => array(
                    'type' => 'INT',
                    'auto_increment' => TRUE
                ),
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
                'user_password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'user_login_type' => array(
                    'type' => 'ENUM("email","facebook")',
                    'default' => 'email',
                    'null' => FALSE,
                ),
                'user_join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'user_update_date TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
            $this->dbforge->drop_table('users');
    }

}