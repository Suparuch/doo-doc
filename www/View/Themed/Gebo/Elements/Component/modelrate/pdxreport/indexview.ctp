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
        var s1 = [6, 10, 19, 150,230,322,404,1200,1901,3256,5454,6745,9635,12321];
        var ticks = ['พล.อ.', 'พล.ท.', 'พล.ต.', 'พ.อ.(พ.)', 'พ.อ.', 'พ.ท.', 'พ.ต.', 'ร.อ.', 'ร.ท.', 'ร.ต.', 'จ.(พ.)', 'จ.', 'ส.อ.', 'พลฯ'];

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
		
    [[['ตํ่ากว่าหรือเท่ากับ 20',120],
['21-30',50],
['31-40',43],
['41-50',55],
['51-60',23],
['61 ขึ้นไป',89]
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
     
	  plot3 = $.jqplot('chart3', [[[120,'สธ.'],
[50,'กง.'],
[43,'กส.'],
[55,'ขว.'],
[23,'ช.'],
[89,'ดย.'],
[22,'ธน.'],
[43,'ป.'],
[26,'ผท.'],
[87,'พ.'],
[33,'พธ.'],
[87,'ม.'],
[213,'ร.'],
[20,'วศ.'],
[42,'ส.'],
[55,'สบ.'],
[72,'สพ.'],
[12,'สห.'],
[34,'ขส.'],
[100,'ทอ.'],
[220,'ทบ.']
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