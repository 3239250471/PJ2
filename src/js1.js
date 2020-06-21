<script>
 var majorCount;
  <?php
  $num2 = count($majors); // $num2 获取专业表中记录的个数
  ?>

  majorCount = <?php echo $num2;?>;
  var  form_majors = new Array();
  <?php
  for($j=0;$j<$num2;$j++)
  {// 从 0开始取出上面 majors[]中存储的专业数据填充数组
  ?>
  form_majors[<?php echo $j;?>] = new Array("<?php echo $majors[$j]['Country_RegionCodeISO'];?>","<?php echo $majors[$j]['AsciiName'];?>");

  <?php
  }
  ?>
</script>