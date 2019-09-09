<div class="container mt-5 ml-lg-5 footer-adjustment">
    <div class="row">
        <?php echo $this->element('sidebar/sticky-sidebar');?>
        <div class="col-lg-8">
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
                <h4 class="card-title font-bold pb-2"><strong><?php echo $pothole['location'];?></strong></h4>
                <div class="view overlay my-4">
                    <img src="http://mtw.sj/<?php echo $images->image_0;?>" class="img-fluid" alt="">
                    <a href="#">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <h5 class="indigo-text font-bold mb-4">Constituency: <a href="#!" class="badge badge-primary"><?php echo $pothole['constituency']['name'];?></a></h5>
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
