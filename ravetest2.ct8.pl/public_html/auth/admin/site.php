<? include("../head.php"); ?>

<div class="card text-center mt-3" style="width: 85%; margin: auto;">
  <div class="card-header">

<ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
        <a href="#stats" class="nav-link active" data-bs-toggle="tab">Statistics</a>
    </li>
    <li class="nav-item">
        <a href="#users" class="nav-link" data-bs-toggle="tab">Users</a>
    </li>
    <li class="nav-item">
        <a href="#announce" class="nav-link" data-bs-toggle="tab">Announcement</a>
    </li>
</ul>

</div>

<div class="card-body">

<div class="tab-content">
    <div class="tab-pane show active" id="stats">
        <p>There are N/A users signed up to <?=$sitename;?>, N/A of which are online right now.</p>
        <p>N/A games and N/A catalog items currently exist on the site.</p>
    </div>
    <div class="tab-pane" id="users">
        <p>Not done</p>
    </div>
    <div class="tab-pane" id="announce">
        <form>
  <div class="form-group">

<div class="input-group">
  <input type="text" class="form-control" placeholder="Enter announcement">
  <span class="input-group-btn">
    <button class="btn btn-success" type="submit">
        Submit
    </button>
  </span>
</div>

    <small id="emailHelp" class="form-text text-muted">All changes to the banner will be logged into our database.</small>
  </div>
</form>
    </div>
</div>

</div>

</div>

<? include("../footer.php"); ?>