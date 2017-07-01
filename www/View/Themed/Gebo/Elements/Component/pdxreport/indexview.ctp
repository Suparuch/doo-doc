			<script type="text/javascript" src="/theme/Gebo/js/jquery.jqplot.min.js"></script>
			<script type="text/javascript" src="/theme/Gebo/js/plugins/jqplot.barRenderer.min.js"></script>
			<script type="text/javascript" src="/theme/Gebo/js/plugins/jqplot.pieRenderer.min.js"></script>
			<script type="text/javascript" src="/theme/Gebo/js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
			<script type="text/javascript" src="/theme/Gebo/js/plugins/jqplot.pointLabels.min.js"></script>
			<link rel="stylesheet" type="text/css" href="/theme/Gebo/js/jquery.jqplot.min.css" />
			
			<table id="mainTable" class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">รายงานกำลังพล แยกตามยศ</th>
							<th style="text-align: center;">รายงานกำลังพล แยกตามอายุ</th>
						</tr>
					</thead>
					<tbody>
					<tr>
					<td>
					<div id='chart1'>
</div>													
							</td>
							<td>
					<div id='chart2'>
</div>													
							</td>
							</tr>					
					</tbody>
				</table>

<table id="mainTable" class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">รายงานกำลังพล แยกตามเหล่า</th>
						</tr>
					</thead>
					<tbody>
					<tr>
					<td>
					<div id='chart3'>
</div>													
							</td>
							
							</tr>					
					</tbody>
				</table>

<script language='javascript'>

        $.jqplot.config.enablePlugins = true;
        var s1 = [40, 119, 383, 1678,2860,4225,5080,4608,3910,7489,8447,38032,4120,4765,9635,23878,9693];
        var ticks = ['พล.อ.', 'พล.ท.', 'พล.ต.', 'พ.อ.(พ.)', 'พ.อ.', 'พ.ท.', 'พ.ต.', 'ร.อ.', 'ร.ท.', 'ร.ต.', 'จ.(พ.)', 'จ.ส.อ.','จ.ส.ท.','จ.ส.ต.' , 'ส.อ.','ส.ท.', 'ส.ต.'];

        plot1 = $.jqplot('chart1', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
		
		plot2 = jQuery.jqplot('chart2', 
		
    [[['ตํ่ากว่าหรือเท่ากับ 20',727],
['21-30',36201],
['31-40',31665],
['41-50',25237],
['51-60',38847],
['61 ขึ้นไป',0]
]], 
    {
      title: ' ', 
	  animate: !$.jqplot.use_excanvas,
      seriesDefaults: {
        shadow: false, 
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: { 
          sliceMargin: 2, 
          showDataLabels: true
        } 
      }, 
      legend: { show:true, location: 'e' }
    }
  );
     
	  plot3 = $.jqplot('chart3', [[
[3590,'กง.'],
[1339,'กส.'],
[1894,'ขว.'],
[12921,'ช.'],
[1269,'ดย.'],
[298,'ธน.'],
[12335,'ป.'],
[213,'ผท.'],
[11719,'พ.'],
[4004,'พธ.'],
[11728,'ม.'],
[39021,'ร.'],
[7790,'ส.'],
[8996,'สบ.'],
[5983,'สพ.'],
[3860,'สห.'],
[5720,'ขส.']
]], {
            captureRightClick: true,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                shadowAngle: 135,
                rendererOptions: {
                    barDirection: 'horizontal',
                    highlightMouseDown: true   
                },
                pointLabels: {show: true, formatString: '%d'}
            },
            legend: {
                show: false,
                location: 'e',
                placement: 'outside'
            },
            axes: {
                yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                }
            }
        });
	 
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
	

</script>