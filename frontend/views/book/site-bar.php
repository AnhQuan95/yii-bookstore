						<!--ASIDE BAR WRAP START-->
						<aside class="col-md-3">

							<!--WIDGET CATEGORIES WRAP START-->
							<div class="widget widget-categories">
								<!--WIDGET HEADING START-->
								<div class="aside-widget-hd">
									<h5>Danh mục sách</h5>
								</div>
								<!--WIDGET HEADING END-->
								<div class="widget-padding">
									<?php if($category): ?>
										<?php foreach($category as $category) : ?>
											<?php 
											$dataSub=new Category();
											$dataSub=$dataSub->getCategoryBy($category->cate_id);
											?>
											<!--WIDGET ACCORDIAN START-->
											<div class="side_accordian">
												<?php if($dataSub):?>
													<div class="accordion" id="<?php echo $category->cate_id ?>">
														<span><?php echo $category->cate_name ?></span>
													</div>
													<?php else: ?>
														<div >
															<span><?php echo $category->cate_name ?></span>
														</div>
													<?php endif; ?>
													<?php if($dataSub):?>
														<div class="accordion-content">
															<?php foreach($dataSub as $valueSub): ?>
																<ul class="side-meta">
																	<li>
																		<?php echo Html::a($valueSub->cate_name,['/book/list-by-category','id'=>$valueSub->cate_id]) ?>
																	</li>
																</ul>
															<?php endforeach; ?>
														</div>
													<?php endif; ?>

												</div>
												<!--WIDGET ACCORDIAN END-->
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
								<!--WIDGET CATEGORIES WRAP END-->

								<!--WIDGET CATEGORIES WRAP START-->
								<div class="widget widget-categories">
									<!--WIDGET HEADING START-->
									<div class="aside-widget-hd">
										<h5>Sách theo độ tuổi</h5>
									</div>
									<!--WIDGET HEADING END-->
									<div class="widget-padding">
										<?php if($age): ?>
											<?php foreach($age as $age) : ?>
												<!--WIDGET ACCORDIAN START-->
												<div class="side_accordian">
													<div >
														<span>
															<?php echo Html::a($age->name_of_age,['/book/list-by-age','id'=>$age->id],['class'=>'age']) ?>
														</span>
													</div>

												</div>
												<!--WIDGET ACCORDIAN END-->
											<?php endforeach; ?>
										<?php endif; ?>

									</div>
								</div>
								<!--WIDGET CATEGORIES WRAP END-->

								<!--WIDGET RANGE SLIDER START-->
								<div class="side-fillter">
									<!--WIDGET HEADING START-->
									<div class="aside-widget-hd">
										<h5>Tìm kiếm theo giá</h5>
									</div>
									<!--WIDGET HEADING END-->
									<!--WIDGET RANGE SLIDER START-->
									<div class="widget-padding">
										<div class="slider-range"></div>
										<div class="rangsldr-meta">
											<span>Giá:</span>
											<input type="text" class="amount" readonly>
											<a href="#" class="add-cart">Tìm</a>
										</div>
									</div>
									<!--WIDGET RANGE SLIDER END-->
								</div>
								<!--WIDGET RANGE SLIDER END-->
								<div class="widget widget-ad">
									<div class="text">
										<h2>Bộ sưu tập <span>Mới</span></h2>
										<div class="clear"></div>
										<p>Giảm giá đến 50%</p>
									</div>
								</div>
							</aside>
							<!--ASIDE BAR WRAP END-->