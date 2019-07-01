<?php

			class Migration_Topics extends CI_Migration {

				public function up() {
					$this->dbforge->add_field(array(
						'id' => array(
							'type' => 'INT',
							'constraint' => 11,
							'auto_increment' => TRUE
						),

						'topic' => array(
							'type' => 'VARCHAR',
							'constraint' => 300,
						),

						'stage_id' => array(
							'type' => 'INT',
							'constraint' => 11,
						),

						'assigned' => array(
							'type' => 'INT',
							'constraint' => 11,
						),

						'script' => array(
							'type' => 'TEXT',
						),

						'doc' => array(
							'type' => 'VARCHAR',
							'constraint' => 300,
						),

						'audio' => array(
							'type' => 'VARCHAR',
							'constraint' => 300,
						),

						'video' => array(
							'type' => 'VARCHAR',
							'constraint' => 300,
						),


						'created_by' => array(
							'type' => 'INT',
							'constraint' => 11,
						),

						'created_at' => array(
							'type' => 'VARCHAR',
							'constraint' => 32,
						),
					));
					$this->dbforge->add_key('id', TRUE);
					$this->dbforge->create_table('topics');
				}

				public function down() {
					$this->dbforge->drop_table('topics');
				}

			}
