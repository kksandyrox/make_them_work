<div class="mt-5 footer-adjustment">
    <div class="row">
        <div class="col-lg-8 offset-lg-3">
            <?php $images = json_decode($pothole['image']); ?>
            <?php 
                if($pothole['severity'] == 1) {
                    $severityClass = "green";
                    $severityVerb = "Low";
                }
                else if($pothole['severity'] == 2) {
                    $severityClass = "orange";
                    $severityVerb = "Moderate";
                }
                else {
                    $severityClass = "red";
                    $severityVerb = "High";
                }
            ;?>
            <div class="jumbotron text-center">
                <?php if($pothole['is_admin_approved'] == 1):?>
                    <?php 
                        echo $this->Form->create($pothole, ['url' => ['controller' => 'potholes', 'action' => 'edit', $pothole["id"], 0]]);
                        echo $this->Form->button(__('UNAPPROVE'), array('class' => 'btn btn-danger'));
                        echo $this->Form->end(); 
                    ?>
                <?php else:?>
                    <?php 
                        echo $this->Form->create($pothole, ['url' => ['controller' => 'potholes', 'action' => 'edit', $pothole["id"], 1]]);
                        echo $this->Form->button(__('APPROVE'), array('class' => 'btn btn-success'));
                        echo $this->Form->end(); 
                    ?>
                <?php endif;?>
                <h4 class="card-title font-bold pb-2"><strong><?php echo $pothole['location'];?></strong></h4>
                <div class="view overlay my-4">
                    <img src="http://mtw.sj/<?php echo $images->image_0;?>" class="img-fluid" alt="">
                </div>

                <h5 class="indigo-text font-bold mb-4">Constituency: <a href="#!" class="badge badge-primary"><?php echo $pothole["constituency"]['name'];?></a></h5>
                <h5 class="indigo-text font-bold mb-4">Severity: <span class="badge badge-pill <?php echo $severityClass;?>"><?php echo $severityVerb;?></span></h5>

                <p class="card-text"><?php echo $pothole['description'];?></p>
                <a class="fa-lg p-2 m-2 li-ic"><i class="fa fa-linkedin grey-text"> </i></a>
                <a class="fa-lg p-2 m-2 tw-ic"><i class="fa fa-twitter grey-text"> </i></a>
                <a class="fa-lg p-2 m-2 fb-ic"><i class="fa fa-facebook grey-text"> </i></a>
            </div>
            <hr />
            <p>More Images</p>
            <?php foreach ($images as $key => $image):?>  
                <a href="http://mtw.sj/<?php echo $image;?>" data-lightbox="roadtrip"><img src="http://mtw.sj/<?php echo $image;?>" alt="thumbnail" class="img-thumbnail" style="width: 200px">
                </a>
            <?php endforeach;?>
        </div>
    </div>
</div>
