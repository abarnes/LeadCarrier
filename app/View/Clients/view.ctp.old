<?php //die(print_r($c)); ?>
<div class="info">
    <h4>Bride Info</h4>
    <p>
	Bride ID: <?php echo $c['Client']['id']; ?><br/>
	Date/Time Submitted: <?php echo date('g:ia m-j-Y',strtotime($c['Client']['created'])); ?><br/>
	First Name: <?php echo $c['Client']['first_name']; ?><br/>
	Last Name: <?php echo $c['Client']['last_name']; ?><br/>
	Email: <a href="mailto:<?php echo $c['Client']['email']; ?>"><?php echo $c['Client']['email']; ?></a><br/>
	Phone: <?php echo $c['Client']['phone']; ?><br/>
	Zip: <?php echo $c['Client']['zip']; ?><br/>
	Wedding Date: <?php echo date('m-j-Y',strtotime($c['Client']['wedding_date'])); ?><br/>
	<?php switch ($c['Client']['approved']){
		case '0':
		    $f = 'pending';
		    break;
		case '1':
		    $f = 'approved';
		    break;
		case '2':
		    $f = 'rejected';
		    break;
	}
	    ?>
	Approval: <?php echo $f; ?>
    </p>
</div>
<br/>

<?php if ($f=='approved') { ?>
<table class="grid">
    <tr>
	<th>
            Industry
        </th>
	<th>
            Vendor 1
        </th>
        <th>
            Vendor 2
        </th>
	<th>
            Vendor 3
        </th>
    </tr>
    <?php
    $arr = array();
    foreach ($c['Record'] as $u) {
	if ($u['select']=='1') {
	    $arr['c'.$u['category_id']][] = $u['vendor_id'];
	}
    }
    //die(print_r($arr));
    
    $g = 1;
    foreach ($arr as $row=>$u) {
	
	if ($g%2>0) {
	    $class = 'row1';
	} else {
	    $class = 'row2';
	}
	$g++;
    ?>
    <tr class="<?php echo $class; ?>">
        <td>
            <?php
	    $cat = substr($row,1);
	    if (array_key_exists($cat,$cats)) {
		echo $cats[$cat];
	    } else {
		echo '[Deleted Industry]';
	    } ?>
        </td>
        <td>
	    <?php
		if ($u[0]!='') {
		    echo $v[$u[0]];
		} else {
		    echo 'Empty';
		}
	    ?>
        </td>
	<td>
	    <?php
		if ($u[1]!='') {
		    echo $v[$u[1]];
		} else {
		    echo 'Empty';
		}
	    ?>
	</td>
	<td>
	    <?php
		if ($u[2]!='') {
		    echo $v[$u[2]];
		} else {
		    echo 'Empty';
		}
	    ?>
	</td>
    </tr>
    <?php } ?>
</table>
<?php } ?>