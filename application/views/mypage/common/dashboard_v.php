<style>
.product_value {padding: 30px 0; font-size:28px; font-weight:700;}
.product_value span {padding-left: 10px; font-size:14px;}
.product_list_wrap {padding-top:20px;}
.product_list_wrap .product_name {font-size:18px; font-weight:700;}
.product_list_wrap .hit_cnt {font-size:16px; font-weight:700; text-align:right;}
</style>
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
                    <?php
                        if($member['member_type'] === '1') {
                    ?>
                    <div class="ibox ">
                        <div class="ibox-title">
							<h5><?php echo $info['company_name']; ?> 제품관리</h5>
						</div>  

                        <div class="ibox-content row">
                            <div class="col-lg-3">
                                <div class="product_title">등록 자사 제품 수</div>
                                <div class="product_value">
                                    <?php echo number_format($own['cnt']); ?>개
                                    <?php
                                        $val = '';
                                        if(!empty($sum['cntown'])) {
                                            $val = 100 - Round($own['cnt'] / $sum['cntown'] * 100);
                                            echo '<span>동종업체<span style="color:red">' . ($val > 0 ? $val : '1') . '%</span></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="product_title">지난주 자사 제품 조회 수</div>
                                <div class="product_value">
                                    <?php echo number_format($own['hit']); ?>
                                    <?php
                                        $val = '';
                                        if(!empty($sum['hitown'])) {
                                            $val = 100 - Round($own['cnt'] / $sum['hitown'] * 100);
                                            echo '<span>동종업체<span style="color:red">' . ($val > 0 ? $val : '1') . '%</span></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="product_title">등록 위탁 생산 제품 수</div>
                                <div class="product_value">
                                    <?php echo number_format($oem['cnt']); ?>개
                                    <?php
                                        $val = '';
                                        if(!empty($sum['cntoem'])) {
                                            $val = 100 - Round($oem['cnt'] / $sum['cntoem'] * 100);
                                            echo '<span>동종업체<span style="color:red">' . ($val > 0 ? $val : '1') . '%</span></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="product_title">지난주 위탁생산 제품 조회 수</div>
                                <div class="product_value">
                                    <?php echo number_format($oem['hit']); ?>
                                    <?php
                                        $val = '';
                                        if(!empty($sum['hitoem'])) {
                                            $val = 100 - Round($oem['hit'] / $sum['cntoem'] * 100);
                                            echo '<span>동종업체<span style="color:red">' . ($val > 0 ? $val : '1') . '%</span></span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-content row">
                            <div class="col-lg-6">
                                <div class="product_title">자사 제품 조회 상위 Top5</div>
                                <div>
                                <?php
                                    if(!empty($own['list'])) {
                                        $cnt = 1;
                                        foreach($own['list'] as $row) {
                                            echo '<div class="row product_list_wrap">';
                                            echo '<div class="col-lg-10 product_name">' . $cnt . ' . ' . $row['product_name'] . '</div>';
                                            echo '<div class="col-lg-2 hit_cnt">' . number_format($row['cnt'])  . '</div>';
                                            echo '</div>';
                                            $cnt++;
                                        }
                                    }
                                    else {
                                        echo '<div style="padding: 50px 0; text-align:center; font-size:16x; font-weight:700;">조회된 제품이 없습니다.</div>';
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product_title">위탁생산 제품 조회 상위 Top5</div>
                                <div>
                                <?php
                                    if(!empty($oem['list'])) {
                                        $cnt = 1;
                                        foreach($oem['list'] as $row) {
                                            echo '<div class="row product_list_wrap">';
                                            echo '<div class="col-lg-10 product_name">' . $cnt . ' . ' . $row['product_name'] . '</div>';
                                            echo '<div class="col-lg-2 hit_cnt">' . number_format($row['cnt'])  . '</div>';
                                            echo '</div>';
                                            $cnt++;
                                        }
                                    }
                                    else {
                                        echo '<div style="padding: 50px 0; text-align:center; font-size:16px; font-weight:700;">조회된 제품이 없습니다.</div>';
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <div class="ibox">
                        <div class="ibox-title">
							<h5><?php echo $info['company_name']; ?> 생산관리</h5>
						</div>  

                        <div class="ibox-content row">
                        </div>
                    </div>


                    <?php
                        }

                    ?>

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
                                                <h2><a href="/mypage/request/detail/<?php echo $row['request_seq']; ?>">
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
                                                </a>
                                                </h2>
                                                <span class="vertical-date" style="float:right;"><?php echo $row['order_date2']; ?></span>
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
                                echo '<div class="ibox-content" style="width:100%; padding:100px; font-size:20px; text-align:center">최근 활동 이력이 없습니다.</div>';
                            }
                        ?>
                    </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" style="padding:10px 30px;" onclick="javascript:location.href='/mypage/request/list'; return false;">의뢰/견적/문의 더보기</button>
                </div>
            </div>

        </div>          
    </div>
</div>