<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Datatables</h5>
          <table class="table datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Position</th>
                <th>Age</th>
                <th>Start Date</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>1</td><td>Brandon Jacob</td><td>Designer</td><td>28</td><td>2016-05-25</td></tr>
              <tr><td>2</td><td>Bridie Kessler</td><td>Developer</td><td>35</td><td>2014-12-05</td></tr>
              <tr><td>3</td><td>Ashleigh Langosh</td><td>Finance</td><td>45</td><td>2011-08-12</td></tr>
              <tr><td>4</td><td>Angus Grady</td><td>HR</td><td>34</td><td>2012-06-11</td></tr>
              <tr><td>5</td><td>Raheem Lehner</td><td>Dynamic Division Officer</td><td>47</td><td>2011-04-19</td></tr>
              <tr><td>6</td><td>Sophia Martinez</td><td>Marketing</td><td>31</td><td>2018-03-14</td></tr>
              <tr><td>7</td><td>Liam Johnson</td><td>Backend Developer</td><td>29</td><td>2019-07-22</td></tr>
              <tr><td>8</td><td>Emma Wilson</td><td>UI/UX Designer</td><td>26</td><td>2020-01-10</td></tr>
              <tr><td>9</td><td>Noah Davis</td><td>Project Manager</td><td>40</td><td>2015-09-03</td></tr>
              <tr><td>10</td><td>Olivia Brown</td><td>Data Analyst</td><td>33</td><td>2017-11-28</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>