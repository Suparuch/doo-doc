					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3><i class="icon-th-list"></i> Plugin elements</h3>
								</div>
								<div class="box-content nopadding">
									<form action="#" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
										<div class="control-group">
											<label for="textfield" class="control-label">Password strength</label>
											<div class="controls">
												<div class="input-xlarge">
													<input type="password" class='complexify-me input-block-level'>
													<span class="help-block">
														<div class="progress progress-info">
															<div class="bar bar-red" style="width: 0%"></div>
														</div>
													</span>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="autocom" class="control-label">Autocomplete input</label>
											<div class="controls">
												<input type="text" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;California&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]">
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Custom Tag input</label>
											<div class="controls">
												<div class="span12"><input type="text" name="textfield" id="textfield" class="tagsinput" value="PHP,Laravel,Java"></div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Select with search</label>
											<div class="controls">
												<div class="input-xlarge"><select name="select" id="select" class='chosen-select'>
													<option value="1">Option-1</option>
													<option value="2">Option-2</option>
													<option value="3">Option-3</option>
													<option value="4">Option-4</option>
													<option value="5">Option-5</option>
													<option value="6">Option-6</option>
													<option value="7">Option-7</option>
													<option value="8">Option-8</option>
													<option value="9">Option-9</option>
												</select></div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Multiple select</label>
											<div class="controls">
												<select name="a" id="a" multiple="multiple" class="chosen-select input-xxlarge">
													<option value="1">Option-1</option>
													<option value="2">Option-2</option>
													<option value="3">Option-3</option>
													<option value="4">Option-4</option>
													<option value="5">Option-5</option>
													<option value="6">Option-6</option>
													<option value="7">Option-7</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Spinner</label>
											<div class="controls">
												<input type="text" name="textfield" id="textfield" value="3" class="spinner input-mini">
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Custom file upload</label>
											<div class="controls">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="input-append">
														<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="aaaa" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label"></label>
											<div class="controls">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" /></span>
													<span class="fileupload-preview"></span>
													<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label"></label>
											<div class="controls">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../../img/no-image.gif" /></div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
														<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name='imagefile' /></span>
														<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Dual multiselect</label>
											<div class="controls">
												<select multiple="multiple" id="my-select" name="my-select[]" class='multiselect'>
													<option value='elem_1'>elem 1</option>
													<option value='elem_2'>elem 2</option>
													<option value='elem_3'>elem 3</option>
													<option value='elem_4'>elem 4</option>
													<option value='elem_100'>elem 100</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Dual multiselect with optgroup</label>
											<div class="controls">
												<select multiple="multiple" id="my-select" name="my-select[]" class='multiselect' data-selectionheader="Selection header" data-selectableheader="Selectable header">
													<optgroup label="Like">
														<option value="1">Option 1</option>
														<option value="2">Option 2</option>
														<option value="3">Option 3</option>
													</optgroup>
													<optgroup label="Dislike">
														<option value="4">Option 4</option>
														<option value="5">Option 5</option>
														<option value="6">Option 6</option>
													</optgroup>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label for="slider" class="control-label">Basic slider (step: 25)</label>
											<div class="controls">
												<div class="slider" data-step="25" data-min="0" data-max="250">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="slider" class="control-label">Range slider</label>
											<div class="controls">
												<div class="slider" data-step="5" data-min="0" data-max="75" data-range="true" data-rangestart="15" data-rangestop="45">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Save changes</button>
											<button type="button" class="btn">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>