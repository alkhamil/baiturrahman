<?php 
if (!$this->userdata) {
    $this->session->set_flashdata('message', 'Opps! please login');
    redirect(base_url('login'),'refresh');
}


include 'header.php';
include 'content.php';
include 'footer.php';

?>