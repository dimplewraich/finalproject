<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
            
			<div class="panel-heading">
				<div class="panel-btns">
					<a href="<?php echo $cancel_url;?>">Back</a>
				</div>
				<h4 class="panel-title"><?php echo $site_info->site_code;?>(<small><?php echo $site_form_info->form_name;?></small>)</h4>
            </div>
			<?php echo form_open_multipart($form_action, ' name="frm-site-feedback" class="form-horizontal"', $hiddenvars);?>
            <div class="panel-body">
				
				<div class="row">
					<div class="col-sm-12">
					
						<table class="table table-primary mb30">
							<thead>
							  <tr>
								<th width="25%">Question</th>
								<th width="50%">Answer</th>
								<th>Notes</th>
							  </tr>
							</thead>
							<tbody>
								<?php foreach($form_questions AS $form_question) {?>
							  <tr>
								<td><?php echo $form_question->question_desc;?></td>
								<td>
									<?php if($form_question->question_type == 'upload') { ?>
									<a href="<?php echo cdn_url() . 'documents/' . $form_question->answer ?>" rel="prettyPhoto[pp_gal_<?php echo $form_question->question_id;?>]" title="">
									<?php
										
										if(isset($form_question->answer)) { 
											$file = cdn_url() . 'documents/' . $form_question->answer;
											$file_headers = @get_headers($file);
											
											if (isset($form_question->answer) && !empty($form_question->answer) && !(strpos($file_headers[0], '404 Not Found'))   && !(strpos($file_headers[0], '403 Forbidden'))) {
												echo '<img src="' . cdn_url() . 'documents/' . $form_question->answer . '" alt="" class="img-responsive" style="margin-left:auto;margin-right:auto;width:100px;" />';
											} else {
												/*echo '<img src="' . $asset_url . 'images/' . 'images/photos/missing_file.png" alt="" class="img-responsive" />';*/
											}
										}
										?>
										
									</a>
									<?php } else { ?>
									<?php echo $form_question->answer;?>
									<?php } ?>
								</td>
								<td><?php echo $form_question->notes;?></td>
							  </tr>
							  <?php } ?>
							</tbody>
						</table>
					
					</div>
				</div>
				
            </div>
			<?php echo form_close();?>
        </div>
	</div>
	
</div>