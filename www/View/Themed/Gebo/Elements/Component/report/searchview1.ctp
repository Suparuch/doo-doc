<h3 class="heading">รายงานสรุปจำนวนข้าราชการแยกตามประเภทนายทหาร</h3>

<form action="/Report1" onsubmit="return chk();" id="SearchIndexForm" method="post" accept-charset="utf-8">
<?php echo $this->Form->create('Reports',array('action' => 'report4','type' => 'get'));?>
<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>

<table class="table table-bordered">
  <tbody>
  <tr>
      <td><b>ยศ</b></td>
      <td>
	<!--
	<select name="data[Search][ranks_id]" id="SearchRanksId">
		<option value=""> - - - - - เลือก - - - - -</option>
		<option value="1">จอมพล</option>
		<option value="2">พล.อ.</option>
		<option value="3">พล.ท.</option>
		<option value="4">พล.ต.</option>
		<option value="5">พ.อ.(พ.)</option>
		<option value="6">พ.อ. </option>
		<option value="7">พ.ท. </option>
		<option value="8">พ.ต. </option>
		<option value="9">ร.อ. </option>
		<option value="10">ร.ท. </option>
		<option value="11">ร.ต. </option>
		<option value="12">จ.ส.อ.(พ.) </option>
		<option value="13">จ.ส.อ.  </option>
		<option value="14">จ.ส.ท.  </option>
		<option value="15">จ.ส.ต.  </option>
		<option value="16">ส.อ. </option>
		<option value="17">ส.ท. </option>
		<option value="18">ส.ต. </option>
	</select>
	-->
		<?php		
		echo $this->Form->input('rank_id', array(
		    'label' => false,
		    'div' => false,
		    'options' => $ranks,
		    'empty' => '- - - - - เลือก - - - - -'
		));		
		?>
	</td>
      <td><b>เหล่า</b></td>
      <td>
        <!--
	<select name="data[Search][soldier_groups_id]" id="SearchSoldierGroupsId">
		<option value=""> - - - - - เลือก - - - - -</option>
		<option value="1">สธ.</option>
		<option value="2">กง.</option>
		<option value="3">กส.</option>
		<option value="4">ขว.</option>
		<option value="5">ช. </option>
		<option value="6">ดย.</option>
		<option value="7">ธน.</option>
		<option value="8">ป. </option>
		<option value="9">ผท.</option>
		<option value="10">พ. </option>
		<option value="11">พธ.</option>
		<option value="12">ม. </option>
		<option value="13">ร. </option>
		<option value="14">วศ.</option>
		<option value="15">ส. </option>
		<option value="16">สบ.</option>
		<option value="17">สพ.</option>
		<option value="18">สห.</option>
		<option value="19">ขส.</option>
		<option value="99">อื่นๆ</option>
	</select>
	-->
		<?php		
		echo $this->Form->input('soldier_group_id', array(
		    'label' => false,
		    'div' => false,
		    'options' => $soldierGroups,
		    'empty' => '- - - - - เลือก - - - - -'
		));		
		?>
	</td>
      <td><b>สังกัด</b></td>
      <td>
        <!--
	<select name="data[Search][soldier_groups_id]" id="SearchSoldierGroupsId">
		<option value=""> - - - - - เลือก - - - - -</option>
	</select>
	-->
		<?php		
		echo $this->Form->input('organization_id', array(
		    'label' => false,
		    'div' => false,
		    'options' => $organizations,
		    'empty' => '- - - - - เลือก - - - - -'
		));		
		?>	
	</td>
</tr>
  <tr>
	<td><b>ประเภท</b></td>
	<td>
	<!--
	<select name="data[GeneralProfile][regis_year]" id="GeneralProfileRegisYear">
		<option value=""> - - - - - เลือก - - - - -</option>
		<option value="1"> - หนุน</option>
		<option value="2"> - นอก</option>
		<option value="3"> - พ้น</option>
	</select>
	-->
		<?php		
		echo $this->Form->input('account_type_id', array(
		    'label' => false,
		    'div' => false,
		    'options' => $accountTypes,
		    'empty' => '- - - - - เลือก - - - - -'
		));		
		?>
	</td>
	<td><b>อายุ</b></td>
	<td colspan=4>
		<select name="data[GeneralProfile][regis_day]" class="input-mini" id="GeneralProfileRegisDay">
			<option value="">วัน</option>
			<option value="1" selected="selected">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>
		<select name="data[GeneralProfile][regis_mount]" class="input-small" id="GeneralProfileRegisMount">
			<option value="">เดือน</option>
			<option value="01" selected="selected">มกราคม</option>
			<option value="02">กุมภาพันธ์</option>
			<option value="03">มีนาคม</option>
			<option value="04">เมษายน</option>
			<option value="05">พฤษภาคม</option>
			<option value="06">มิถุนายน</option>
			<option value="07">กรกฎาคม</option>
			<option value="08">สิงหาคม</option>
			<option value="09">กันยายน</option>
			<option value="10">ตุลาคม</option>
			<option value="11">พฤศจิกายน</option>
			<option value="12">ธันวาคม</option>
		</select>
		<select name="data[GeneralProfile][regis_year]" class="input-small" id="GeneralProfileRegisYear">
			<option value="">ปี</option>
			<option value="2476">2476</option>
			<option value="2477">2477</option>
			<option value="2478">2478</option>
			<option value="2479">2479</option>
			<option value="2480">2480</option>
			<option value="2481">2481</option>
			<option value="2482">2482</option>
			<option value="2483">2483</option>
			<option value="2484">2484</option>
			<option value="2485">2485</option>
			<option value="2486">2486</option>
			<option value="2487">2487</option>
			<option value="2488">2488</option>
			<option value="2489">2489</option>
			<option value="2490">2490</option>
			<option value="2491">2491</option>
			<option value="2492">2492</option>
			<option value="2493">2493</option>
			<option value="2494">2494</option>
			<option value="2495">2495</option>
			<option value="2496">2496</option>
			<option value="2497">2497</option>
			<option value="2498">2498</option>
			<option value="2499">2499</option>
			<option value="2500">2500</option>
			<option value="2501">2501</option>
			<option value="2502">2502</option>
			<option value="2503">2503</option>
			<option value="2504">2504</option>
			<option value="2505">2505</option>
			<option value="2506">2506</option>
			<option value="2507">2507</option>
			<option value="2508">2508</option>
			<option value="2509">2509</option>
			<option value="2510">2510</option>
			<option value="2511">2511</option>
			<option value="2512">2512</option>
			<option value="2513">2513</option>
			<option value="2514">2514</option>
			<option value="2515">2515</option>
			<option value="2516">2516</option>
			<option value="2517">2517</option>
			<option value="2518">2518</option>
			<option value="2519">2519</option>
			<option value="2520">2520</option>
			<option value="2521">2521</option>
			<option value="2522">2522</option>
			<option value="2523">2523</option>
			<option value="2524">2524</option>
			<option value="2525">2525</option>
			<option value="2526">2526</option>
			<option value="2527">2527</option>
			<option value="2528">2528</option>
			<option value="2529">2529</option>
			<option value="2530">2530</option>
			<option value="2531">2531</option>
			<option value="2532">2532</option>
			<option value="2533">2533</option>
			<option value="2534">2534</option>
			<option value="2535">2535</option>
			<option value="2536">2536</option>
			<option value="2537">2537</option>
			<option value="2538">2538</option>
			<option value="2539">2539</option>
			<option value="2540">2540</option>
			<option value="2541">2541</option>
			<option value="2542">2542</option>
			<option value="2543">2543</option>
			<option value="2544">2544</option>
			<option value="2545">2545</option>
			<option value="2546">2546</option>
			<option value="2547">2547</option>
			<option value="2548">2548</option>
			<option value="2549">2549</option>
			<option value="2550">2550</option>
			<option value="2551">2551</option>
			<option value="2552">2552</option>
			<option value="2553">2553</option>
			<option value="2554">2554</option>
			<option value="2555">2555</option>
			<option value="2556">2556</option>
		</select>
		<b>ถึง</b>
		<select name="data[GeneralProfile][regis_day]" class="input-mini" id="GeneralProfileRegisDay">
			<option value="">วัน</option>
			<option value="1" selected="selected">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>
		<select name="data[GeneralProfile][regis_mount]" class="input-small" id="GeneralProfileRegisMount">
			<option value="">เดือน</option>
			<option value="01" selected="selected">มกราคม</option>
			<option value="02">กุมภาพันธ์</option>
			<option value="03">มีนาคม</option>
			<option value="04">เมษายน</option>
			<option value="05">พฤษภาคม</option>
			<option value="06">มิถุนายน</option>
			<option value="07">กรกฎาคม</option>
			<option value="08">สิงหาคม</option>
			<option value="09">กันยายน</option>
			<option value="10">ตุลาคม</option>
			<option value="11">พฤศจิกายน</option>
			<option value="12">ธันวาคม</option>
		</select>
		<select name="data[GeneralProfile][regis_year]" class="input-small" id="GeneralProfileRegisYear">
			<option value="">ปี</option>
			<option value="2476">2476</option>
			<option value="2477">2477</option>
			<option value="2478">2478</option>
			<option value="2479">2479</option>
			<option value="2480">2480</option>
			<option value="2481">2481</option>
			<option value="2482">2482</option>
			<option value="2483">2483</option>
			<option value="2484">2484</option>
			<option value="2485">2485</option>
			<option value="2486">2486</option>
			<option value="2487">2487</option>
			<option value="2488">2488</option>
			<option value="2489">2489</option>
			<option value="2490">2490</option>
			<option value="2491">2491</option>
			<option value="2492">2492</option>
			<option value="2493">2493</option>
			<option value="2494">2494</option>
			<option value="2495">2495</option>
			<option value="2496">2496</option>
			<option value="2497">2497</option>
			<option value="2498">2498</option>
			<option value="2499">2499</option>
			<option value="2500">2500</option>
			<option value="2501">2501</option>
			<option value="2502">2502</option>
			<option value="2503">2503</option>
			<option value="2504">2504</option>
			<option value="2505">2505</option>
			<option value="2506">2506</option>
			<option value="2507">2507</option>
			<option value="2508">2508</option>
			<option value="2509">2509</option>
			<option value="2510">2510</option>
			<option value="2511">2511</option>
			<option value="2512">2512</option>
			<option value="2513">2513</option>
			<option value="2514">2514</option>
			<option value="2515">2515</option>
			<option value="2516">2516</option>
			<option value="2517">2517</option>
			<option value="2518">2518</option>
			<option value="2519">2519</option>
			<option value="2520">2520</option>
			<option value="2521">2521</option>
			<option value="2522">2522</option>
			<option value="2523">2523</option>
			<option value="2524">2524</option>
			<option value="2525">2525</option>
			<option value="2526">2526</option>
			<option value="2527">2527</option>
			<option value="2528">2528</option>
			<option value="2529">2529</option>
			<option value="2530">2530</option>
			<option value="2531">2531</option>
			<option value="2532">2532</option>
			<option value="2533">2533</option>
			<option value="2534">2534</option>
			<option value="2535">2535</option>
			<option value="2536">2536</option>
			<option value="2537">2537</option>
			<option value="2538">2538</option>
			<option value="2539">2539</option>
			<option value="2540">2540</option>
			<option value="2541">2541</option>
			<option value="2542">2542</option>
			<option value="2543">2543</option>
			<option value="2544">2544</option>
			<option value="2545">2545</option>
			<option value="2546">2546</option>
			<option value="2547">2547</option>
			<option value="2548">2548</option>
			<option value="2549">2549</option>
			<option value="2550">2550</option>
			<option value="2551">2551</option>
			<option value="2552">2552</option>
			<option value="2553">2553</option>
			<option value="2554">2554</option>
			<option value="2555">2555</option>
			<option value="2556">2556</option>
		</select>

	</td>
	
  </tr>
  <tr>
 	<td><b>สถานะ</b></td>
	<td colspan=5>
	<!--
	<select name="data[GeneralProfile][regis_year]" id="GeneralProfileRegisYear">
		<option value=""> - - - - - เลือก - - - - -</option>
		<option value="1">มีชีวิต</option>
		<option value="0">เสียชีวิต</option>
	</select>
	-->
		<?php		
		echo $this->Form->input('account_status_id', array(
		    'label' => false,
		    'div' => false,
		    'options' => $accountStatus,
		    'empty' => '- - - - - เลือก - - - - -'
		));		
		?>		
	</td> 
</tr>
</tbody>
</table>

<div style="width: 500px;"><input name="submit" type="submit" value="ค้นหา" class="btn btn-success"></div>
<?php echo $this->Form->end();?>