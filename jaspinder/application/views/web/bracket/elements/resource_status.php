<?php if( isset($params['table_label']) && $params['table_label'] == TRUE) { ?>
<span style="float:left;margin:2px 2px 0px 0;line-height:22px;"><span class="tlabel <?php echo !empty($params['css_class'])?$params['css_class']: 'label-default';?> btip" rel="tooltip" data-placement="right" title="<?php echo $params['resource_status'];?>"><?php echo $params['resource_name'];?></span></span>
<?php }else{ ?>
<span class="label <?php echo !empty($params['css_class'])?$params['css_class']: 'label-default';?> btip" rel="tooltip" data-placement="right" title="<?php echo $params['resource_status'];?>"><?php echo $params['resource_name'];?></span>
<?php } ?>