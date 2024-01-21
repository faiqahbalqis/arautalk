@extends('layouts.app')
@section('content')

<div class="container">
      <nav class="breadcrumb">
        <a href="#" class="breadcrumb-item"> Home</a>
        <span class="breadcrumb-item active">Category overview</span>
      </nav>

      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <!-- Category one -->
            <div class="col-lg-12">
              <!-- second section  -->
              <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                Forum Category
              </h4>
              <table
                class="table table-striped table-responsive table-bordered mb-xl-0"
              >
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Forum</th>
                    <th scope="col">Topics</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Latest Post</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <h3 class="h5">
                        <a href="#" class="text-uppercase">Forum name</a>
                      </h3>
                      <p class="mb-0">
                        forum description.......................................
                      </p>
                    </td>
                    <td><div>5</div></td>
                    <td><div>20</div></td>
                    <td>
                      <h4 class="h6 font-weight-bold mb-0">
                        <a href="#">Post name</a>
                      </h4>
                      <div><a href="#">Author name</a></div>
                      <div>06/07/ 2021 20:04</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3 class="h5">
                        <a href="#" class="text-uppercase">Forum name</a>
                      </h3>
                      <p class="mb-0">
                        forum description
                      </p>
                    </td>
                    <td><div>5</div></td>
                    <td><div>20</div></td>
                    <td>
                      <h4 class="h6 font-weight-bold mb-0">
                        <a href="#">Post name</a>
                      </h4>
                      <div><a href="#">Author name</a></div>
                      <div>06/07/ 2021 20:04</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
    
@endsection