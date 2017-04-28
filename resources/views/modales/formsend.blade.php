 <div class="modal fade large_bootbox" id="modal-send-rec" tabindex="-1" role="dialog" style="z-index: 999999999">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background: #5cb85c">
        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h2 class="modal-title" style="font-weight: bold; color: #000; text-align: center;font-size: 1.2em" id="song_name">
          
        </h2>
        <br/>
        <h2 class="modal-title" style="font-weight: normal; color: white; text-align: center;font-size: 1em" id="title">
          Please enter phone number receive
        </h2>
        <div style="text-align: center;">
          <span id="response" style="text-align: center;"></span>
          <span id="response-user" style="text-align: center;"></span>
          <span id="span" style="color : #fff ;text-align: center;font-weight: bold"></span>
          <br/>
          <span id="response-pin" style="color : #fff ;text-align: center;font-weight: bold;"></span>
          <span id="success" style="color : #fff ;text-align: center;font-weight: bold;"></span>

          <span id="response-pin-one" style="color : #fff ;text-align: center;font-weight: bold"></span>
          <span id="ytitle" style="color : #fff ;text-align: center;font-weight: bold"></span>

        </div>

      </div>

      <div class="modal-body">

        <div class="row">

          <div class="col-md-3 col-sm-4 col-xs-4" id="operator_logo">

          </div>
          <div class="col-md-9 col-sm-8 col-xs-8" id="op_text" style="display: none;">
            You are about to subscribe to "Send a Song" for 1.5 USD/week through your <span id="op_name"></span> account and it will be automatically renewed every week.
            Click continue to proceed.
          </div>
        </div>
        <br/>
        <div class="row">
          <div class="col-md-3 col-sm-4 col-xs-3" id="zip">
            <input type="tel" disabled class="form-control" placeholder="961" style="text-align: center;">
          </div>


          <div class="col-md-9 col-sm-8 col-xs-9" id="step_one">
            <input type="tel" id="phone_number_rec" class="form-control" placeholder="Enter mobile number receive" required="" style="text-align: center">
          </div>


          <div class="col-md-9 col-sm-8 col-xs-9" id="step_two" style="display: none">
            <input type="tel" id="phone_number" class="form-control" placeholder="Enter your mobile number" required="" style="text-align: center">
          </div>


          <div class="col-md-12 col-sm-12 col-xs-12" id="step_three" style="display: none; text-align: center;margin: auto;">
            <input type="tel" id="pin_code" class="form-control" placeholder="Enter pin code" required="" style="text-align: center">
          </div>




          <div class="col-md-12 col-sm-12 col-xs-12" id="sendsong_one" style="display: none; text-align: center;margin: auto;">
           <button type="button" class="btn btn-default" data-dismiss="modal">dismiss</button>
           <button type="button" class="btn btn-success" onclick="send_song()" id="agree">Agree</button>
         </div>


         <div class="col-md-12 col-sm-12 col-xs-12" id="request_pin_button" style="display: none; text-align: center;margin: auto;">
           <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
           <button type="button" class="btn btn-success" onclick="one_time_payment_req()" id="btn_req">Continue</button>
         </div>


         <div class="col-md-12 col-sm-12 col-xs-12" id="pin_code_verification_form" style="display: none; text-align: center;margin: auto;">
          <input type="tel" id="pin_code_one_time" class="form-control" placeholder="Enter pin code one time payment" required="" style="text-align: center">
        </div>
      </div>
    </div>

    <!-- Modal rec -->
    <div class="modal-footer" id="step_one_button">
      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      <button type="button" class="btn btn-success" onclick="check_phone_number_rec()" id="confirm_btn_one">Continue</button>
    </div>

    <!-- Modal user -->
    <div class="modal-footer" id="step_two_button" style="display: none;">
      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      <button type="button" class="btn btn-success" onclick="check_phone_number()" id="confirm_btn_two">Continue</button>
    </div>

    <!-- Modal user -->
    <div class="modal-footer" id="step_three_button" style="display: none;">
      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      <button type="button" class="btn btn-success" onclick="check_pin_code()" id="confirm_btn_three">Check pin</button>
    </div>
    <!-- Modal user -->
    <div class="modal-footer" id="pin_code_verification_form_button" style="display: none;">
      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      <button type="button" class="btn btn-success" onclick="check_pin_code_one_time()" id="confirm_btn_one_time">Check pin</button>
    </div>
  </div>
</div>

</div>