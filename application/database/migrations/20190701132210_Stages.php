<?php

			class Migration_Stages extends CI_Migration {

				public function up() {
					$this->dbforge->add_field(array(
						'id' => array(
							'type' => 'INT',
							'constraint' => 11,
							'auto_increment' => TRUE
						),

						'name' => array(
							'type' => 'VARCHAR',
							'constraint' => 64,
						)
					));
					$this->dbforge->add_key('id', TRUE);
					$this->dbforge->create_table('stages');
				}

				public function down() {
					$this->dbforge->drop_table('stages');
				}

			}
