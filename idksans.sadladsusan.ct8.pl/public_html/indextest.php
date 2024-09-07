<?php
$pagename = 'Home';
$pagelink = 'www.dimensious.com';
include('header.php');
?>
<?php
$id = $myu->id;
if ($user) {
?>
<style data-jss="" data-meta="Unthemed">
.container-0-2-24 {
  max-width: 1200px!Important;
}
.headshotWrapper-0-2-25 {
  border: 1px solid #c3c3c3;
  overflow: hidden;
  background: white;
  box-shadow: 0 -5px 20px rgba(25,25,25,0.15);
  border-radius: 100%;
}
.helloMessage-0-2-26 {
  font-size: 40px;
  font-weight: 600;
}
@media(min-width: 980px) {
  .helloMessage-0-2-26 {
    margin-top: 60px;
    margin-left: 20px;
  }
}
.subHeader-0-2-27 {
  color: #4a4a4a;
  font-size: 24px;
  font-weight: 300;
}
.card-0-2-28 {
  box-shadow: 0 -5px 20px rgba(25,25,25,0.15);
}
.friendRow-0-2-29 {
  overflow: auto;
  flex-flow: row;
  margin-right: -7px;
}
.mainBody-0-2-30 {
  background: #e3e3e3;
}
</style>
<style data-jss="" data-meta="Unthemed">
.image-0-2-39 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
  max-width: 400px;
}
</style>



<div class='container'>
    <div class='row'>
      <div class='d-none d-lg-flex col-2'>j</div>
      <div class='col-12 col-lg-8 mainBody'>
        <div class='row'>
          <div class='col-3'>
            <div class='headshotWrapper'>
              <PlayerHeadshot id={auth.userId} name={auth.username} />
            </div>
          </div>
          <div class='col-9'>
            <h3 class='helloMessage'>Hello, {auth.username}!</h3>
          </div>
        </div>
        {friends && <div class='row mt-4'>
          <div class='col-12'>
            <h3 class='subHeader'>Friends ({friends.length})</h3>
            <div class='card pt-3 pb-3 ps-3 pe-2'>
              <div class='row friendRow'>
                {
                  friends.map(v => {
                    return <FriendEntry key={v.id} {...v} />
                  })
                }
              </div>
            </div>
          </div>
        </div>



<?php
} else {
header('Location: /Landing');
}
?>
<?php
include('footer.php');
?>