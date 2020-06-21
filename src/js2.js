<script>
changeCollege1 =  function (s)

    {


        var majorCount; // 存储专业记录条数

// form_majors[]

alert(s);

        <?php

        $num2 = count($majors); // $num2 获取专业表中记录的个数

        ?>

        majorCount = <?php echo $num2;?>;


        document.stu_add_form.major.length = 0;


        var j;

        document.stu_add_form.major.options[0] = new Option('==选择城市 ==',''); // label的 value为空 ' '

        for (j=0;j < majorCount; j++) // 从 0开始判断

        {

            if (form_majors[j]['0'] === s) // if college_id等于选择的学院的 id

            {

                document.stu_add_form.major.options[document.stu_add_form.major.length] = new Option(form_majors[j]['1']);

            }

        }

    }

</script>