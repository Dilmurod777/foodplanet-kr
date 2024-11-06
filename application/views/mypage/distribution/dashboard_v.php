<div id="wrapper" style="min-height:800px !important;">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg" style="min-height:800px !important;">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="wrapper wrapper-content">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Dashboard</h2>
                </div>
            </div>
            <div class="row animated fadeInRight">
                <div class="col-lg-12">

                    <div class="ibox ">
                        <div class="ibox-title">
							<h5>최근활동내역</h5>
						</div>  

                        <?php
                            if(!empty($list)) {
                        ?>
                                <div class="ibox-content" id="ibox-content">
                                    <div id="vertical-timeline" class="vertical-container dark-timeline">

                        <?php
                                foreach($list as $row) {
                                    $type_name = '';
                        ?>
                                        <div class="vertical-timeline-block">
                                        <?php
                                            if($row['req_type'] === '1') {
                                                echo '<div class="vertical-timeline-icon blue-bg">';
                                                echo '  <i class="fa fa-tags"></i>';
                                                echo '</div>';
                                                $type_name = '의뢰를';
                                            }
                                            else if($row['req_type'] === '2') {
                                                echo '<div class="vertical-timeline-icon yellow-bg">';
                                                echo '  <i class="fa fa-file-text"></i>';
                                                echo '</div>';
                                                $type_name = '발주서를';
                                            }
                                            else {
                                                echo '<div class="vertical-timeline-icon navy-bg">';
                                                echo '  <i class="fa fa-comments"></i>';
                                                echo '</div>';
                                            }
                                        ?>
                                            <div class="vertical-timeline-content">
                                                <h2>
                                                <?php
                                                    if($row['req_type'] == '3') {
                                                        if($member['member_cd'] === $row['req_member_cd']) {
                                                            if($row['status'] == 'req') {
                                                                echo $row['target_company_name'] . '님 (' . $row['target_member_level'] . ')에게 문의를 발송하였습니다.';
                                                            }
                                                            else {
                                                                echo $row['target_company_name'] . '님 (' . $row['target_member_level'] . ')으로부터 답변을 수신받았습니다.';
                                                            }
                                                        }
                                                        else {
                                                            if($row['status'] == 'req') {
                                                                echo $row['req_company_name'] . '님 (' . $row['req_member_level'] . ')으로부터 문의를 수신받았습니다.';
                                                            }
                                                            else {
                                                                echo $row['req_company_name'] . '님 (' . $row['req_member_level'] . ')에게 답변을 발송하였습니다.';
                                                            }
                                                        }
                                                    }
                                                    else {
                                                        if($member['member_cd'] === $row['req_member_cd']) {
                                                            echo $row['target_company_name'] . '님 (' . $row['target_member_level'] . ')에게 ' . $type_name . ' 발송하였습니다.';
                                                        }
                                                        else {
                                                            echo $row['req_company_name'] . '님 (' . $row['req_member_level'] . ')으로부터 ' . $type_name . ' 수신하였습니다.';
                                                        }
                                                    }
                                                ?>
                                                </h2>
                                                <p><?php echo $row['status'] === 'req' ? $row['req_title'] : $row['ans_title']; ?></p>
                                                <span class="vertical-date"><?php echo $row['order_date2']; ?></span>
                                            </div>
                                        </div>
                        <?php
                                }
                        ?>
                                    </div>

                                </div>

                        <?php
                            }
                            else {
                                echo '<div class="ibox" style="width:100%; padding:100px; font-size:20px; text-align:center">최근 활동 이력이 없습니다.</div>';
                            }
                        ?>
                    </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/mypage/request/list'; return false;">의뢰/견적/문의 더보기</button>
                </div>
            </div>

        </div>          
    </div>
</div>