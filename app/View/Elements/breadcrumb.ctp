<div class="clearfix"></div>
<br/>




<nav aria-label="breadcrumb">
<ol class="breadcrumb" style="margin-bottom: 5px;">
    <?php
    $total = 0;
    if(!isset($breadCurmb['path'])) $breadCurmb['path']  = array();

    foreach ($breadCurmb['path'] as $key => $href){
        if($total==0){
            echo '<li '. (isset($href['active'])?'class="breadcrumb-item active"':'class="breadcrumb-item "') .'>
                        <a href="'. (isset($href['link']) ? $href['link'] :'#').'">
                            <i class="fa fa-dashboard"></i> &nbsp;'.$href['title'] .'</a>
                        </li> &nbsp;';
        }else{
            echo '<li '. (isset($href['active'])?'class="breadcrumb-item active"':'class="breadcrumb-item "') .'>
                        <a href="'. (isset($href['link']) ? $href['link'] :'#').'">'.$href['title'] .'</a></li>';
        }
        $total++;
    }
    ?>
</ol>
</nav>

<h5 style="margin-top: 10px;">
    <?php
    $total = 0;
    if(!isset($breadCurmb['title'])) $breadCurmb['title']  = array();
    foreach ($breadCurmb['title'] as $key => $data){
        if($total==0){
            echo $data;
        }else{
            echo '<small>'. $data .'</small>';
        }
        $total++;
    }
    ?>
</h5>
