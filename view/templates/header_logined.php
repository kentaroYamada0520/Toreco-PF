<header>
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php print HOME_URL; ?>">ToReCo</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#headerNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="headerNav" style="margin-left:200px;">
      <ul class="navbar-nav mr-auto">
        <li>
          <form class="d-flex" action="index.php" method="post">
          <input class="form-control me-2" type="search" name="search" id="search" placeholder="アイテム検索" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">検索</button>
          </form>
        </li>
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
          <a class="nav-link active" style="text-align:left;" href="<?php print LOGOUT_URL; ?>"style=align:right;">ログアウト</a>
      </li>
      </ul>
    </div>
  </nav>
  <p>ようこそ、<?php print h($user['user_name']); ?>さん。</p>
</header>