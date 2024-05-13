<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Motoring Community - Forum</title>
  <script defer src="JS/forum.js"></script>

  <!-- Link al archivo CSS -->
</head>

<body>
  <link rel="stylesheet" href="CSS/forum.css" />

  <section class="main">
    <article class="posts-container" id="postsContainer">
      <div class="main-bar">
        <div class="main-bar-filter">
          <div class="select">
            <select id="filter">
              <option value="Default">Default</option>
              <option value="Popularity">Popularity</option>
              <option value="Views">Views</option>
              <option value="Newest">Newest</option>
            </select>
          </div>
        </div>
        <div class="main-bar-search">
          <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
              <g>
                <path
                  d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                </path>
              </g>
            </svg>
            <input id="search" placeholder="Search" type="search" class="input" />
          </div>
        </div>
        <div class="main-bar-add">
          <button class="button-add" role="button">Add new Theme</button>
        </div>
      </div>
      <div class="posts-container-info">
        <h1 id="orderP">Order by: Default.</h1>
        <h1 id="countPostP"></h1>
      </div>
      <div id="posts-group" class="posts-group">
        <?php
        include "PHP/Forum/returnThemes.php";
        $themes = returnThemesByDefault();
        for ($i = 0; $i < sizeof($themes); $i++) {
          echo '<div id="post-card-container" class="post-card-container">
          <div class="post-card">
            <div class="post-card-1">
              <h1>Posted by: ' . returnNombreUsu($themes[$i][3]) . '</h1>
              <p>Posted on: ' . $themes[$i][2] . '</p>
            </div>
            <div class="post-card-2">
              <div class="post-card-3">
                <h1>
                ' . $themes[$i][1] . '
                </h1>
              </div>
              <div class="post-card-4">
                <div class="post-card-5">
                  <p id="pLimit">
                    ' . returnLastPost($themes[$i][0]) . '
                  </p>
                </div>
                <div class="post-card-6">
                  <div class="post-card-views">
                    <img src="Images/view.svg" alt="" />
                    <p>16</p>
                  </div>
                  <div class="post-card-msg">
                    <img src="Images/msg.svg" alt="" />
                    <p>' . returnNumberPosts($themes[$i][0]) . '</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>';
        }
        ?>
      </div>
      <div class="pagination" id="pagination">
        <h1>Page:</h1>
      </div>
    </article>
  </section>
  <?php
  include "footer.php";
  ?>
</body>
</html>