<form action="<?php echo URL ?>/schedules/create_schedule" method="post">
  <select name="year_level_id">
    <?php while($yl = $year_levels->fetch_object()) : ?>
    <option value="<?php echo $yl->id ?>"><?php echo $yl->name ?></option>
    <?php endwhile; ?>
  </select>
</form>

<?php echo $output; ?>

<div style="clear: both;"></div>