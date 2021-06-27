@include('header')


 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Overview
            </h3>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card  card-img-holder card-text">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">Total Category
                  </h4>
                  <h2 class="mb-5"><span></span>{{ count($category) }}</h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">Total Brand
                  </h4>
                  <h2 class="mb-5">{{ count($brand) }}</h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Total Product
                  </h4>
                  <h2 class="mb-5">{{ count($product) }}</h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Visit And Sales Statistics</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
                  </div>
                  <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Traffic Sources</h4>
                  <canvas id="traffic-chart"></canvas>
                  <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>                                                      
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Deals</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            ID
                          </th>
                          <th>
                            Deal Name
                          </th>
                          <th>
                            Portfolio
                          </th>
                          <th>
                            Category
                          </th>
                          <th>
                            Created on
                          </th>
                          <th>
                           Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            10020
                          </td>
                          <td>
                            Country Inn & Suits Inc.
                          </td>
                          <td>
                            -----
                          </td>
                          <td>
                           <button type="button button-outline-primary">Hotel</button>
                          </td>
                          <td>
                            12-07-2018
                          </td>
                          <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>                      
                          </td>
                        </tr>
                        <tr>
                          <td>
                            10020
                          </td>
                          <td>
                            Country Inn & Suits Inc.
                          </td>
                          <td>
                            -----
                          </td>
                          <td>
                           <button type="button button-outline-primary">Hotel</button>
                          </td>
                          <td>
                            12-07-2018
                          </td>
                          <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>                      
                          </td>
                        </tr>
                        <tr>
                          <td>
                            10020
                          </td>
                          <td>
                            Country Inn & Suits Inc.
                          </td>
                          <td>
                            -----
                          </td>
                          <td>
                           <button type="button button-outline-primary">Hotel</button>
                          </td>
                          <td>
                            12-07-2018
                          </td>
                          <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>                      
                          </td>
                        </tr>
                        <tr>
                          <td>
                            10020
                          </td>
                          <td>
                            Country Inn & Suits Inc.
                          </td>
                          <td>
                            -----
                          </td>
                          <td>
                           <button type="button button-outline-primary">Hotel</button>
                          </td>
                          <td>
                            12-07-2018
                          </td>
                          <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>                      
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
@include('footer')