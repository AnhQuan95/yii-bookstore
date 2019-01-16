         <?php 
         use backend\models\Category;
         use backend\models\SuitableAge;
         use yii\helpers\Html;
         use yii\bootstrap\ActiveForm;
         use backend\models\BookWithAuthor;
         
         $cat=new Category();
         $category=$cat->getCategoryBy();

         $books=new BookWithAuthor;


         $suitable_age=new SuitableAge();
         $age=$suitable_age->getSuitableAgeBy(); ?>  

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
                        <?php foreach($category as $item) : ?>
                            <?php 

                            $data=new Category();
                            $dataSub=$data->getCategoryBy($item->cate_id);
                            $count_pr= $books->getQuantityByCat($item->cate_id);

                            ?>
                            <!--WIDGET ACCORDIAN START-->
                            <div class="side_accordian">
                                <?php if($dataSub):?>
                                    <div class="accordion" id="<?php echo $item->cate_id ?>">

                                      <?php echo Html::a($item->cate_name.' ('.$count_pr.')',['/book/list-by-category','id'=>$item->cate_id],['class'=>'cate']) ?>
                                  </div>
                                  <?php else: ?>
                                    <div >
                                        <span>
                                            <?php echo Html::a($item->cate_name.' ('.$count_pr.')',['/book/list-by-category','id'=>$item->cate_id],['class'=>'cate']) ?>    
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if($dataSub):?>
                                    <div class="accordion-content">
                                        <?php foreach($dataSub as $valueSub): ?>
                                            <?php
                                            $count_bk= $books->getQuantityByCat($valueSub->cate_id);?>
                                            <ul class="side-meta">
                                                <li>
                                                    <?php echo Html::a($valueSub->cate_name.' ('.$count_bk.')',['/book/list-by-category','id'=>$valueSub->cate_id]) ?>
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
                           <?php $count_bk_age=$books->getQuantityByAge($age->id);?>
                           <!--WIDGET ACCORDIAN START-->
                           <div class="side_accordian">
                            <div >
                                <span>
                                    <?php echo Html::a($age->name_of_age.' ('.$count_bk_age.')',['/book/list-by-age','id'=>$age->id],['class'=>'age']) ?>
                                </span>
                            </div>

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
                <h5>Tìm kiếm theo giá</h5>
            </div>
            <!--WIDGET HEADING END-->
            <div class="widget-padding">
               <?php $form = ActiveForm::begin(
                [
                    'id' => 'form-search-price',
                    'method'=>'get',
                    'action'=>Yii::$app->urlManager->baseUrl.'/book/list-by-price'
                ]); ?>
                <p>Danh mục :
                    <?php $cate=$cat->getParent();
                    ?>
                    <?php if($cate): ?>
                        <select class="form-control" name="cate">
                            <?php foreach ($cate as $key=>$item) : ?>
                               <option value="<?php echo $key?>"><?php echo $item?></option>
                           <?php endforeach; ?>
                       </select></p>
                   <?php endif; ?>
                   <p>Giá từ :<select class="form-control" name="price_from">
                    <option value="0" selected="">0 VNĐ</option>
                    <option value="100000">100.000 VNĐ</option>
                    <option value="200000">200.000 VNĐ</option>
                    <option value="300000">300.000 VNĐ</option>
                    <option value="400000">400.000 VNĐ</option>
                    <option value="500000">500.000 VNĐ</option>
                    <option value="600000">600.000 VNĐ</option>
                    <option value="700000">700.000 VNĐ</option>
                    <option value="800000">800.000 VNĐ</option>
                    <option value="900000">900.000 VNĐ</option>
                    <option value="1000000">1.000.000 VNĐ</option>
                    <option value="1100000">1.100.000 VNĐ</option>
                    <option value="1200000">1.200.000 VNĐ</option>
                    <option value="1300000">1.300.000 VNĐ</option>
                </select>
            </p>
            <p>
                đến : <select class="form-control" name="price_to">
                    <option value="100000">100.000 VNĐ</option>
                    <option value="200000">200.000 VNĐ</option>
                    <option value="300000">300.000 VNĐ</option>
                    <option value="400000">400.000 VNĐ</option>
                    <option value="500000">500.000 VNĐ</option>
                    <option value="600000">600.000 VNĐ</option>
                    <option value="700000">700.000 VNĐ</option>
                    <option value="800000">800.000 VNĐ</option>
                    <option value="900000">900.000 VNĐ</option>
                    <option value="1000000">1.000.000 VNĐ</option>
                    <option value="1100000">1.100.000 VNĐ</option>
                    <option value="1200000">1.200.000 VNĐ</option>
                    <option value="1300000">1.300.000 VNĐ</option>
                    <option value="1400000">1.400.000 VNĐ</option>
                </select>
            </p>
            <p>    <?= Html::submitButton('Tìm kiếm ', ['class' => 'btn btn-info']) ?></p>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <!--WIDGET CATEGORIES WRAP END-->

    <!--WIDGET RANGE SLIDER END-->
    <div class="widget widget-ad">
        <div class="text">
            <h2>Bộ sưu tập <span>Mới</span></h2>
            <div class="clear"></div>
            <p>Giảm giá đến 50%</p>
        </div>
    </div>
</aside>