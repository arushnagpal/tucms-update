<section id="main" class="container">
    <header>
        <h3 style="margin-bottom:0px;">Poll Results</h3>
    </header>
    <div id="fadeandscale" style="margin: auto; ">
        <div id="chartContainer" style="height: 300px; width: 500px; "></div>
    </div>
    <div class="row">
        <?php foreach ($query as $ro) { ?>
            <div class="6u" >
                <section class="box" >
                    <h2><?php echo $ro['ques'] ?></h2>
                    <ol>
                        <li><?php echo $ro['op1'] ?></li>
                        <li><?php echo $ro['op2'] ?></li>
                        <?php if($ro['op3']!='NULL') echo "<li>".$ro['op3']."</li>" ?>
                        <?php if($ro['op4']!='NULL') echo "<li>".$ro['op4']."</li>" ?>
                    </ol>
                    <button class="fadeandscale_open button special" onclick=" show('<?php echo $ro['ques'] ?>', '<?php echo $ro['op1'] ?>', '<?php echo $ro['op2'] ?>', '<?php echo $ro['op3'] ?>', '<?php echo $ro['op4'] ?>',<?php echo $ro['poll_c1'] ?>,<?php echo $ro['poll_c2'] ?>,<?php echo $ro['poll_c3'] ?>,<?php echo $ro['poll_c4'] ?>)"> Show Result</button>
                </section>
            </div>
        <?php }
        ?>
    </div>
</section>

<script defer>
    function show(q, o1, o2, o3, o4, c1, c2, c3, c4) {
	var m=Math.max(c1,c2,c3,c4);
	var temp;
	if(c2===m)
	{
	temp=c1;
	c1=c2;
	c2=temp;
	temp=o1;
	o1=o2;
	o2=temp;
	}
	if(c3===m)
	{
	temp=c1;
	c1=c3;
	c3=temp;
	temp=o1;
	o1=o3;
	o3=temp;
	}
	if(c4===m)
	{
	temp=c1;
	c1=c4;
	c4=temp;
	temp=o1;
	o1=o4;
	o4=temp;
	}
	
        var chart = new CanvasJS.Chart("chartContainer",
                {
                    title: {
                        text: q
                    },
                    animationEnabled: true,
                    legend: {
                        verticalAlign: "bottom",
                        horizontalAlign: "center"
                    },
                    data: [
                        {
                            indexLabelFontSize: 20,
                            indexLabelFontFamily: "Monospace",
                            indexLabelFontColor: "darkgrey",
                            indexLabelLineColor: "darkgrey",
                            indexLabelPlacement: "outside",
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{y} - <strong>#percent%</strong>",
                            dataPoints: [
                                {y: c1, legendText: o1,exploded:true, indexLabel: o1},
                                {y: c2, legendText: o2,indexLabel: o2},
                                {y: c3, legendText: o3, indexLabel: o3},
                                {y: c4, legendText: o4, indexLabel: o4}
                            ]
                        }
                    ]
                });
        chart.render();
		
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/canvasjs.min.js" defer></script>
<script>
    $(document).ready(function() {
        // Initialize the plugin
        $('#fadeandscale').popup({
            transition: 'all 0.3s' //optional
        });
    });
</script>