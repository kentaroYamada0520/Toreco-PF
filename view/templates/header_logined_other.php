<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
</head>
<header>
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php print HOME_URL; ?>">Toreco</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#headerNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="headerNav" style="margin-left:200px;">
    <form class="d-flex" action="index.php" method="post" style="margin-right:10px">
          <input class="form-control me-2" type="search" name="search" id="search" placeholder="アイテム検索" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">検索</button>
          </form>
    <ul class="navbar-nav mr-auto" style="margin-left:0px;">
        <li class="nav-item">
          <a class="nav-link active" href="<?php print LISTING_URL; ?>">出品</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print TRADE_REQUEST_URL; ?>">トレードリクエスト</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print LISTING_TABLE_URL; ?>">出品一覧</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print PURCHASE_HISTORY_URL; ?>">履歴</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print CART_URL; ?>">カートへ</a>
        </li>
        <li class="nav-item">
           <a class="nav-link active" href="<?php print MYPAGE_URL; ?>">マイページ</a>
        </li>
        <li class="nav-item">
           <a class="nav-link active" href="<?php print LOGOUT_URL; ?>">ログアウト</a>
        </li>
      </div>
      </ul>
  </nav>
</header>