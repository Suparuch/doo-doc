
<div id="jCrumbs" class="breadCrumb module">
    <ul>
        <li>
            <a href="#"><i class="icon-home"></i></a>
        </li>
            <?php if(!empty($breadcrumb['controller']['name'])) { ?>
        <li>
            <?php if(!empty($breadcrumb['controller']['url'])) {?>
            <a href="<?php echo "../../".$breadcrumb['controller']['url'];  ?>">
            <?php } ?>    
 
            <?php   
                    
                    echo $breadcrumb['controller']['name']; 
            ?>
            </a>
           
        </li>
 
            <?php if(!empty($breadcrumb['action']['name'])) { ?>
        <li>
                <?php if(empty($breadcrumb['details']) && !empty($breadcrumb['action']['url'])) { ?>                
                        <a href="<?php $breadcrumb['controller']['url']."/".$breadcrumb['action']['url'];  ?>"> 
                        <?php echo $breadcrumb['action']['name']; ?>
                        </a>

                <?php }else { ?>
                    <?php echo $breadcrumb['action']['name']; ?>
                <?php } ?>
        </li>
            <?php } ?>

            <?php  if(!empty($breadcrumb['paramDetails'])) { ?>
        <li>      
            <?php  echo $breadcrumb['paramDetails'];  ?>
        </li>       
            <?php } ?>
            <?php } ?>

        
    </ul>
</div>

