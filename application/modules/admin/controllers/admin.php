
<?php if (! defined("BASEPATH")) exit("No direct access to the script allowed");

/**
* 
*/
class Admin extends MY_Controller
{
	
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('m_admin');
	}

	public function index()
	{
		$data['content_view'] = "admin_dashboard";
		$data['title'] = 'Administrators Section: Dashboard';

		$this->load->view('admin_template_view', $data);
	}

	public function lectures()
	{
		$data['content_view'] = "lecture_view";
		$data['title'] = 'Administrators Section: Lecturers';
		$data['lecture'] ; 

		$this->load->view('admin_template_view', $data);
	}

	public function students()
	{
		$data['content_view'] = "students_view";
		$data['title'] = 'Administrators Section: Sudents';
		$data['stude'] = $this->admin_model->get_students();

		$this->load->view('admin_template_view', $data);
	}

	function add()
	{
		// $this->createCoursesSection();
		
		$this->load->view('admin');
	}

		function add_lecturer()
	{
		// $this->createCoursesSection();
		$data['courses'] = $this ->m_admin->get_courses();
		$this->load->view('add_lecturer',$data);
	}

	public function addLecturer()
	{
		// print_r($this->input->post());die;
		$path = '';
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		// print_r($this->upload->do_upload('photos'));die;
		if ( ! $this->upload->do_upload('lec_photo'))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			foreach ($data as $key => $value) {
				$path = base_url().'upload/'.$value['file_name'];
			}

			$this->m_admin->add_lec($path);
			// echo "Success!";die;
		}
		// $this->m_admin->addStudent();
	}


	public function addStudent()
	{
		// print_r($this->input->post());die;
		$path = '';
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		// print_r($this->upload->do_upload('photos'));die;
		if ( ! $this->upload->do_upload('photos'))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			foreach ($data as $key => $value) {
				$path = base_url().'upload/'.$value['file_name'];
			}

			$this->m_admin->addStudent($path);
			// echo "Success!";die;
		}
		// $this->m_admin->addStudent();
	}

	public function createCoursesSection()
	{
		$course_section = '';
		$course_section = $this->m_admin->getAllCourses();

		$course .= '<select name = "course">';
		foreach ($courses as $key => $value) {
			$course_section .= '<option value = '.$value['course_id'].'>'.$value['course_name'].'</option>';
		}
		$course_section .= '</select>';

		echo $course_section;die;
	}
}


?>


