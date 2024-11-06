<script>
$(document).ready(function() {
	showAlert('error', '<?php echo $msg; ?>', function() { location.href="<?php echo empty($move) ? '/member/login' : $move; ?>";});
});
</script>