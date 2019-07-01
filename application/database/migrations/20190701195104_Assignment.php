<?php

			class Migration_Assignment extends CI_Migration {

				public function up() {
					$this->dbforge->add_field(array(
						'id' => array(
							'type' => 'INT',
							'constraint' => 11,
							'auto_increment' => TRUE
						),

						'topic_id' => array(
							'type' => 'INT',
							'constraint' => 11,
						),

						'user_id' => array(
							'type' => 'INT',
							'constraint' => 11,
						)
					));
					$this->dbforge->add_key('id', TRUE);
					$this->dbforge->create_table('assignment');
				}

				public function down() {
					$this->dbforge->drop_table('assignment');
				}

			}
