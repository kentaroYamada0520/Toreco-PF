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
          <a class="nav-link active" href="<?php print LISTING_URL; ?>">アイテム出品</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print TRADE_REQUEST_URL; ?>">トレードリクエスト</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print LISTING_TABLE_URL; ?>">アイテム出品一覧</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print TRADE_SUCCESS_HISTORY_URL; ?>">トレード履歴</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php print CART_URL; ?>">カートへ</a>
        </li>
        
      <li class="nav-item">
          <a class="nav-link active" style="text-align:left;" href="<?php print LOGOUT_URL; ?>"style=align:right;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
  <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
</svg></a>
      </li>
      </div>
      </ul>
  </nav>
  <p>ようこそ、<?php print h($user['user_name']); ?>さん。</p>
</header>