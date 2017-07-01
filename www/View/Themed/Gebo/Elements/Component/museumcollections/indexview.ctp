<?php
echo $this->Html->css(array(
    'jquery-ui-1.8.4.custom',
));

//echo $this->Html->script(array(
//    'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
//    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js',
//));

$cbunny = array(
    'APP_PATH' => Router::url('/', true)
);
echo $this->Html->scriptBlock('var CbunnyObj = ' . $this->Javascript->object($cbunny) . ';');
?>

<style type="text/css">
    #myModal2{
        width:1000px;
        margin-left:-500px;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">

            <div class="box-content nopadding">
                <form action="../../MuseumCollections" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขประจำวัตถุ : </label>
                            <div class="controls">
                                <input type="text" name='txtMcNo' value="<?php echo (isset($default) && $default['txtMcNo'] != '') ? $default['txtMcNo'] : ''; ?>">
                            </div>
                        </div>

                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อพิพิธภัณฑ์ : </label>
                            <div class="controls">
                                
<!--                                <select name="ddlMuseum"  data-placeholder="" class="chzn_a input-xlarge" style="width:280px;" >
                                    <option value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($MuseumNames as $MuseumName) { ?>
                                        <option value="<?php echo $MuseumName['MuseumCollection']['mc_museum']; ?>"><?php echo $MuseumName['MuseumCollection']['mc_museum']; ?></option>
                                    <?php } ?>
                                </select>
                                <script>
                                    $('select[name="ddlMuseum').val('<?php echo (isset($default) && $default['ddlMuseum'] != '0') ? $default['ddlMuseum'] : '0'; ?>');
                                </script>-->

                                <?php
                                echo $this->Ajax->autoComplete_ui('txtMuseum', array(
                                    'source' => array(
                                        'controller' => 'MuseumCollections',
                                        'action' => 'autoComplete',
                                    ),
                                ));
                                ?>


                            </div>
                        </div>

                    </div>

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขอื่นที่เคยใช้ : </label>
                            <div class="controls">
                                <input type="text" name='txtMcOldNo' value="<?php echo (isset($default) && $default['txtMcOldNo'] != '') ? $default['txtMcOldNo'] : ''; ?>">
                            </div>
                        </div>

                        <div class="span6">
                            <label for="textfield" class="control-label">สภาพวัตถุ : </label>
                            <div class="controls">
                                <select name="ddlMcCondition" style="width:130px;">
                                    <option value="">เลือกทั้งหมด</option>
                                    <option value="0" <?php echo (isset($default) && $default['ddlMcCondition'] == '0') ? "selected='selected'" : ''; ?>>ชำรุด</option>
                                    <option value="1" <?php echo (isset($default) && $default['ddlMcCondition'] == '1') ? "selected='selected'" : ''; ?>>สมบูรณ์</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อวัตถุ : </label>
                            <div class="controls">
                                <input type="text" name='txtMcName' value="<?php echo (isset($default) && $default['txtMcName'] != '') ? $default['txtMcName'] : ''; ?>">
                            </div>
                        </div>

                        <div class="span6">
                            <label for="textfield" class="control-label">วัตถุพิพิธภัณฑ์ที่ถูกยืม : </label>
                            <div class="controls">
                                <input type="checkbox" name="chkMcCondition" value="1" <?php echo (isset($default) && isset($default['chkMcCondition'])) ? "checked='checked'" : ''; ?>>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="offset" value="0">

                    <!--<button type="submit" class="btn btn-primary"></button>-->

                    <button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list" style="display: inline-block; "><?php echo __('ค้นหา'); ?></button>

                    <!--<button type="button" class="btn">Cancel</button>-->


                </form>
            </div>

            <div class="row-fluid">
                <div class="span4">
                    <div class="dt_actions span4">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="hideme mm_13_add" style="display: list-item;">
                                    <a href="#myModal2" onclick="addMuseumCollection();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-add"></i>เพิ่ม</a>
                                </li>

                                <li class='add_rows_simple hideme mm_3_delete'> <a href="#" class="delete" data-tableid="smpl_tbl" style="display: block;"><i class="icon-trash"></i> ลบ </a></li>

                                <li class="hideme mm_13_add" style="display: list-item;">
                                    <a href="#myModal2" onclick="printMuseumCollectionReport();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-document_a4_marked"></i> รายงานทะเบียนวัตถุพิพิธภัณฑ์ 
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <!--                <div class="span8">
                                    <div class="dataTables_filter" id="dt_gal_filter">
                                        <label>
                                            <form action="../../EDocument/index/150120132326915176" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                                <input name="name_th" style="width:400px;" value="" type="text" placeholder="เหตุการณ์ หลักฐาน">
                                                <button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_13_list" style="display: inline-block;">ค้นหา</button>
                                                <input type="hidden" name="offset" value="0">
                                            </form>
                                        </label>						
                                    </div>
                                </div>-->
            </div>

            <div class="box-content nopadding">
                <div class="tab-content tab-content-inline">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleMuseumCollection(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: center;width:90px;">เลขประจำวัตถุ</th>
                                <th style="text-align: center;width:90px;">เลขอื่นที่เคยใช้</th>
                                <th style="text-align: center;width:150px;">ชื่อวัตถุ</th>
                                <th style="text-align: center;">ลักษณะวัตถุ</th>
                                <th style="text-align: center;width:80px;">สภาพวัตถุ</th>
                                <th style="text-align: center;width:110px;">ภาพหลักวัตถุ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($MuseumCollections)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($MuseumCollections as $MuseumCollection) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="MuseumCollectionID[]" value="<?php echo $MuseumCollection['MuseumCollection']['id']; ?>">
                                        </td> 

                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style="text-align: center;"><?php echo $MuseumCollection['MuseumCollection']['mc_no']; ?></td>
                                        <td style="text-align: center;"><?php echo $MuseumCollection['MuseumCollection']['mc_old_no']; ?></td>
                                        <td style="text-align: center;"><?php echo $MuseumCollection['MuseumCollection']['mc_name']; ?></td>
                                        <td style="text-align: center;"><?php echo $MuseumCollection['MuseumCollection']['mc_nature']; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            if ($MuseumCollection['MuseumCollection']['mc_condition'] == '0')
                                                echo "ชำรุด";
                                            else
                                                echo "สมบูรณ์";
                                            ?>
                                        </td>
                                        <td style="text-align: center;">                 
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'MuseumCollections';
                                            $whereConditions['id'] = $MuseumCollection['MuseumCollection']['mc_file_id'];
                                            $conditions = array('limit' => 1,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<a href='/files/museum_collections/" . $modelFiles[0]["TableAttachFile"]["file_name"] . "' target='_blank'>";
                                                echo "<img src='/files/museum_collections/" . $modelFiles[0]["TableAttachFile"]["file_name"] . "' style='width:100px;height:70px;object-fit:cover;' />";
                                                echo "</a>";
                                            }
                                            ?>
                                        </td>

                                        <td style="text-align: center;">
                                            <a href="../../MuseumCollections/printItemCard/<?php echo $MuseumCollection['MuseumCollection']['id']; ?>" target="_blank" style="display: inline;"><i class="icon-print"></i></a>&nbsp;
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editMuseumCollection('<?php echo $MuseumCollection['MuseumCollection']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $MuseumCollection['MuseumCollection']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="9" style="text-align:center;">
                                        ไม่พบข้อมูลที่ตรงกัน
                                    </td>
                                </tr>      
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    function toggleMuseumCollection(source)
    {
        var checkboxes = document.getElementsByName('MuseumCollectionID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addMuseumCollection() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างวัตถุพิพิธภัณฑ์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../MuseumCollections/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editMuseumCollection(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลวัตถุพิพิธภัณฑ์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../MuseumCollections/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function printMuseumCollectionReport() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('รายงานทะเบียนวัตถุพิพิธภัณฑ์');
        $('#customModalAction2').html('แสดงรายงาน');
        $('#customModal2').load("../../MuseumCollections/FormConRptMuseumCollection", function (data) {
            $('#customModal2').html(data);
        });
    }

    function printItemCard(id) {
        window.open("../../MuseumCollections/printItemCard/" + id, "_blank");
    }

    function deleteMuseumCollection(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../MuseumCollections/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../MuseumCollections";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='MuseumCollectionID[]']");
        var ids = [];
        $.each(checkboxes, function (key, checkbox) {
            if (checkbox.checked === true) {
                ids.push(checkbox.value);
            }
        });
        return ids;
    }

    $(".delete").click(function () {
        var id = $(this).attr("value");
        deleteMuseumCollection(id);
    });
</script>