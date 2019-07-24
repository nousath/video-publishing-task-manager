<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ratings_model extends CI_Model
{

    public $table = 'ratings';
    public $user_id = 'user_id';
    public $id = 'id';
    public $order = 'DESC';

    // function __construct()
    // {
    //     parent::__construct();
    // }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_users(){	
		$this->db->where("usertype != 1");
		$this->db->order_by('id', 'DESC');
		 return $this->db->get('users');
	}

	function get_num_user_rating($user_id){
		$this->db->where($this->user_id, $user_id);
        return $this->db->get($this->table)->num_rows();
	}

	function get_user_rating($user_id){
		$this->db->select("AVG(rating) as rating");
		$this->db->from("ratings");
		$this->db->where("user_id", $user_id);
		$data =	$this->db->get();

		foreach ($data->result_array() as $row ) {
			return $row["rating"];
		}
	}

	function html_output(){
		$data = $this->get_all_users();
		$output = '';
		foreach ($data->result_array() as $row) {
			$number_of_ratings = $this->get_num_user_rating($row["id"]);
			$color = '';
			$rating = $this->get_user_rating($row["id"]);
			$output .= '<div class="col-md-3">
						<img src="'.base_url($row['photo']).'" width="100" min-height="100" class="img img-responsive img-circle">
						<h3 class="text text-primary">'.$row['username'].'</h3>
						<ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">';

			for ($count = 1; $count <= 5; $count++) { 
				if($count <= $rating){
					$color = "color:#ffcc00";
				}else{
					$color = "color:#ccc";
				}

				$output .= '<li title="'.$count.'" id="'.$row['id'].'-'.$count.'" data-index="'.$count.'" data-user_id="'.$row['id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.'" ><i class="fa fa-star fa-1x"></i></li>';
			}
			
			$output .= '<strong>'.number_format($rating,1).'</strong></ul>
				<p>rated '.$number_of_ratings.' times</p>
				<label class="text text-danger">'.$row['email'].'</label>
				</div>';
		}

		echo $output;

	}


	function insert_rating($data){
		$this->db->insert('ratings', $data);			
	}




    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}


// <i class="fa fa-star fa-1x"></i>

