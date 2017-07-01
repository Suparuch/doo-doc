
<div id="jCrumbs" class="breadCrumb module">
    <ul>
        <li>
            <a href="#"><i class="icon-home"></i></a>
        </li>
        <?php if (!empty($breadcrumb['controller']['name'])) { ?>
            <li>
                <?php
                echo (!empty($breadcrumb['controller']['url'])) ? "<a href='../../" . $breadcrumb['controller']['url'] . "'>" : "";
                echo "<span>";
                echo $breadcrumb['controller']['name'];
                
                if (!empty($breadcrumb['controller']['subtitle'])) {
                    echo "&nbsp;»&nbsp;";
                    echo "<span class='txt-green' style='display:inline'>".$breadcrumb['controller']['subtitle']."</span>";
                }
                echo "</span>";
                echo (!empty($breadcrumb['controller']['url'])) ? "</a>" : "";
                ?>
            </li>
        <?php } ?>
    </ul>
</div>

