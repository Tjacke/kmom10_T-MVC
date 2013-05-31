


<div id="login">


    <?
    if ($this->session->userdata('is_logged_in')) {
        
       echo '<a href="' . base_url() . 'medlem">Min Sida</a><br />';
       echo '<a href="' . base_url() . 'admin">Admin</a><br />';
       echo '<a href="' . base_url() . 'loggain/loggaut">Logga ut</a>';
    }
    ?>

</div> <!-- end login -->


