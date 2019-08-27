			<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

			class Stock_model extends CI_Model {


			var $table = 'stock';
			var $column = array('itemcode','itemname','quantity','balance','id'); //set column field database for order and search
			var $column_search = array('itemcode','date','itemname','quantity','balance','id'); //set column field database for datatable searchable 
			var $order = array('id' => 'asc'); // default order 

			public function __construct()
			{
				parent::__construct();
				$this->load->database();
			}

			private function _get_datatables_query()
			{
				if($this->input->post('fromdate'))
				{
					//echo "inside";
					$this->db->where('date >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
				}
				if($this->input->post('todate'))
				{
					//echo "inside todate";
					$this->db->where('date <=',date('Y-m-d',strtotime($this->input->post('todate'))));
				}
				//$this->db->where('balance > ','0');
				$this->db->from($this->table);

				$i = 0;
				foreach ($this->column_search as $item) // loop column 
				{
					if($_POST['search']['value']) // if datatable send POST for search
					{
						if($i===0) // first loop
						{
						//$this->db->group_start(); 
						$this->db->like($item, $_POST['search']['value']);
						}
						else
						{
						$this->db->or_like($item, $_POST['search']['value']);
						}
					}
					$i++;
				}
				//$this->db->where('balance >',0);
				/*$this->db->or_like('itemcode',$_POST['search']['value']);		
				$this->db->or_like('itemname',$_POST['search']['value']);
				$this->db->or_like('quantity',$_POST['search']['value']);	
				$this->db->or_like('balance',$_POST['search']['value']);*/


			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by('id', $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
			}



			function get_datatables()
			{
				$this->_get_datatables_query();
				if($_POST['length'] != -1)
					$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function count_filtered()
			{
				if($this->input->post('fromdate'))
				{
					//echo "inside";
					$this->db->where('date >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
				}
				if($this->input->post('todate'))
				{
					//echo "inside todate";
					$this->db->where('date <=',date('Y-m-d',strtotime($this->input->post('todate'))));
				}
				//$this->db->where('balance > ','0');
				$this->_get_datatables_query();
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function count_all()
			{
				if($this->input->post('fromdate'))
				{
					//echo "inside";
					$this->db->where('date >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
				}
				if($this->input->post('todate'))
				{
					//echo "inside todate";
					$this->db->where('date <=',date('Y-m-d',strtotime($this->input->post('todate'))));
				}
				//$this->db->where('balance > ','0');
				$this->db->from($this->table);
				return $this->db->count_all_results();
			}

			public function get_by_id($id)
			{
				$this->db->from($this->table);
				$this->db->where('id',$id);
				$query = $this->db->get();

				return $query->row();
			}

			public function delete_by_id($id)
			{
				$this->db->where('id', $id);
				$this->db->delete($this->table);
			}


			public function add($data)
			{
				$this->db->insert('stock',$data);
				return $this->db->affected_rows()!=1? false:true;
			}

			public function select()
			{
				$this->db->select('*');
				$this->db->from('stock');
				$this->db->order_by('id','desc');
				return $this->db->get()->result_array();

			}

			public function overallreports()

			{

				$this->db->select('*');
				$this->db->from('stock');
				return $this->db->get()->result_array();


			}


			public function insert_stock($c)
			{
				$this->db->insert('stock',$c);
				return ($this->db->affected_rows() !=1) ? false:true;

			}	


			public function check($b)
			{

				$this->db->where('itemname',$b);
				$query = $this->db->get('stock');
				if($query->num_rows >0)
				{
					return true;
				}		

			}

			public function get_last_stock($b)
			{
				$this->db->select('*');
				$this->db->from('stock');
				$this->db->where('itemname',$b);
				$this->db->order_by('id','desc');
				$this->db->limit('1');
				$query= $this->db->get();
				return $query->result();


			}
			public function stock_update($itemname,$data)
			{	

				$this->db->where('itemname',$itemname);
				$this->db->update('stock',$data);
				return ($this->db->affected_rows() !=1) ? false:true;

			}	

			public function header($data,$id)
			{


				$this->db->where('id',$id);
				$this->db->update('stock',$data);
				return $this->db->affected_rows()!=1? false:true;
			}



			public function search_stock()
			{
				if($this->input->post('fromdate')=='') { $fromdate=''; } else { $fromdate=date('Y-m-d',strtotime($this->input->post('fromdate'))); }
				if($this->input->post('todate')=='') { $todate=''; } else { $todate=date('Y-m-d',strtotime($this->input->post('todate'))); }
				if(@$fromdate) { $this->db->where('date >=',$fromdate); }
				if(@$todate) { $this->db->where('date <=',$todate); }
				$this->db->order_by('date','desc');
				return $query= $this->db->get('stock')->result_array();
			}


			}

