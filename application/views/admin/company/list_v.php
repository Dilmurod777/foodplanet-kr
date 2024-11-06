<div id="wrapper" style="min-height:800px">
        
        <?php $this->load->view('admin/common/include/nav_v'); ?>
		
        <div id="page-wrapper" class="gray-bg">
            <?php $this->load->view('admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>기업 관리</h2>
                </div>
            </div>

            <form method="post" action="/admin/company/excelBI01" enctype="multipart/form-data">
                <label>BI01</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI011" enctype="multipart/form-data">
                <label>BI011</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form  method="post" action="/admin/company/excelBI02" enctype="multipart/form-data">
                <label>BI02</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI03" enctype="multipart/form-data">
                <label>BI03</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI03_product" enctype="multipart/form-data">
                <label>BI03_product</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI031" enctype="multipart/form-data">
                <label>BI031</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI032" enctype="multipart/form-data">
                <label>BI032</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI04" enctype="multipart/form-data">
                <label>BI04</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI05" enctype="multipart/form-data">
                <label>BI05</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI06" enctype="multipart/form-data">
                <label>BI06</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelBI07" enctype="multipart/form-data">
                <label>BI07</label>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>



            <form method="post" action="/admin/company/excelOverseasNI02" enctype="multipart/form-data">
                <label>상위수출품목</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelOverseasBI01" enctype="multipart/form-data">
                <label>바이어</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelOverseasEI00" enctype="multipart/form-data">
                <label>주요품목요건</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
            <form method="post" action="/admin/company/excelOverseasMI01" enctype="multipart/form-data">
                <label>시장동향</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>

            <form method="post" action="/admin/company/excelOverseasPI00" enctype="multipart/form-data">
                <label>제품등록</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>

            <form method="post" action="/admin/company/excelOverseasPI02" enctype="multipart/form-data">
                <label>HSCODE정보등록</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <select name="product_seq">
                    <option value="1">고추장</option>
                    <option value="2">곡류가공품</option>
                    <option value="3">김</option>
                    <option value="4">김치</option>
                    <option value="5">떡</option>
                    <option value="6">라면</option>
                    <option value="7">빵</option>
                    <option value="8">음료</option>
                    <option value="9">차</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>

            <form method="post" action="/admin/company/excelOverseasEI01" enctype="multipart/form-data">
                <label>수입요건관련</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <select name="product_seq">
                    <option value="1">고추장</option>
                    <option value="2">곡류가공품</option>
                    <option value="3">김</option>
                    <option value="4">김치</option>
                    <option value="5">떡</option>
                    <option value="6">라면</option>
                    <option value="7">빵</option>
                    <option value="8">음료</option>
                    <option value="9">차</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>

            <form method="post" action="/admin/company/excelOverseasEI02" enctype="multipart/form-data">
                <label>수입처관련법령</label>
                <select name="nation_seq">
                    <option value="1">중국</option>
                    <option value="2">일본</option>
                    <option value="3">미국</option>
                    <option value="4">베트남</option>
                    <option value="5">대만</option>
                    <option value="6">홍콩</option>
                    <option value="7">태국</option>
                    <option value="8">인도네시아</option>
                    <option value="9">러시아</option>
                    <option value="10">EU</option>
                </select>
                <select name="product_seq">
                    <option value="1">고추장</option>
                    <option value="2">곡류가공품</option>
                    <option value="3">김</option>
                    <option value="4">김치</option>
                    <option value="5">떡</option>
                    <option value="6">라면</option>
                    <option value="7">빵</option>
                    <option value="8">음료</option>
                    <option value="9">차</option>
                </select>
                <input type="file" name="excel">
                <button type="submit">저장</button>
            </form>
        </div>
    </div>
