<?php $message = get_flash_message(); ?>
<?php if (isset($message['msg']) && $message['msg']) : ?>
    <script type="text/javascript">
        $(document).ready(function() {
            gl.pnotify('<?php echo $message['msg_type']; ?>','<?php echo strtoupper($message['msg_type']); ?>','<?php echo str_replace(array("\n\t","\n"),'',$message['msg']); ?>');
        });
    </script>
<?php endif; ?>
