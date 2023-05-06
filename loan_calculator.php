
<?php
/*
Plugin Name: Simple Loan Calculator
Description: A simple loan calculator plugin for WordPress.
Version: 1.0
Author: Kibru Tekle
*/

function loan_calculator_shortcode() {
    ob_start();
    ?>
    <!-- Loan Form Start Here -->
    <form id="loan-calculator-form">
    <div class="row" style="font-family:SF UI Display; padding-bottom:-70px;">
        <div class="col"> 
            <div style="padding:20px;"> 
                <label for="loan-amount">Loan Amount <span style="color:red;">*</span></label> </br>
                <input type="text" name="loan-amount" id="loan-amount" class="form-control numbers" data-value="1000000" value="100000" required>
            </div>

            <div style="padding:20px;">
                <label for="interest-rate">Interest Rate<span style="color:red;">*</span></label> </br>
                <input type="text" name="interest-rate" id="interest-rate" class="form-control" data-value="15" value="15" required>
            </div>

            <div style="padding:20px;"> 
                <label for="loan-term">Loan Term in Months<span style="color:red;">*</span></label> </br>
                <input type="text" name="loan-term" id="loan-term" class="form-control" data-value="10" value="10" required>
            </div>
        </div>

        <div class="col"> 
                <p style="font-size: 23px; color: black;  padding-top: 20px; padding-left: 45px;">Monthly Payment</p>
                <p id="monthly-payment" style="font-size: 60px; margin-top:-30px; font-weight: bold;  padding-left: 45px; background-image: linear-gradient(89.73deg, #4a176d 21.2%, #00b0ad 94.14%);background-size: 100%;background-repeat: repeat;-webkit-background-clip: text;-webkit-text-fill-color: transparent; -moz-background-clip: text;-moz-text-fill-color: transparent;" class="number"><strong></strong></p>
                
            <div class="row" style="margin-top:-70px; padding-bottom:-5px;">
                <div class="col"> 
                    <div> 
                    <p style="font-size: 15px; padding-left: 45px;">Total Interest</p>
                    <p id="total-interest" style="color: #4a176d; font-size: 20px; font-weight: bold;padding-left: 45px; " class="number"></p>

                    </div>
                </div>

                <div class="col"> 
                    <div> 
                    <p style="font-size: 15px; padding-left: 45px;">Total Principal & Interest</p>
                    <p id="total-payment" style="color: #4a176d; font-size: 20px; font-weight: bold; padding-left: 45px;" class="number"></p>
                    </div>
                </div>

            </div>
                
        </div>

    </div>   
    </form>
<!-- Loan Form End Here -->

<!-- Loan Calculator Start Here -->
<!-- It calculate loan .... -->
    <script>
jQuery(document).ready(function($) {
  try {
    var loanAmountInput = $('#loan-amount');
    var interestRateInput = $('#interest-rate');
    var loanTermInput = $('#loan-term');
    var monthlyPaymentOutput = $('#monthly-payment');
    var totalInterest = $('#total-interest');
    var totalPayment = $('#total-payment');

    function calculateLoan() {
      var loanAmount = parseFloat(loanAmountInput.val()) || 0;
      var interestRate = parseFloat(interestRateInput.val()) / 100 / 12 || 0;
      var loanTerm = parseInt(loanTermInput.val()) * 12 || 0;


    // var input = document.getElementById("loan-amount");
    // input.value = parseInt(input.value, 10).toLocaleString();


      var loan_amount = loanAmount.toLocaleString();
      document.getElementById("loan-amount").innerHTML = loan_amount+ "  Br";

      var monthlyPayment = (loanAmount * interestRate) / (1 - Math.pow(1 + interestRate, -loanTerm));
      monthlyPaymentOutput.text(monthlyPayment.toFixed(2) + "  Br");

      var formattedNumber = monthlyPayment.toLocaleString();
      document.getElementById("monthly-payment").innerHTML = formattedNumber + "  Br";

      var totInterest = (monthlyPayment * loanTerm)/10;
      totalInterest.text(totInterest.toFixed(2) + "  Br");

      var total_interest = totInterest.toLocaleString();
      document.getElementById("total-interest").innerHTML = total_interest + "  Br";

      var tot = loanAmount + totInterest;
      totalPayment.text(tot.toFixed(2) + "  Br");

      var total_payment = tot.toLocaleString();
      document.getElementById("total-payment").innerHTML = total_payment + "  Br";
    }

    calculateLoan();

    loanAmountInput.add(interestRateInput).add(loanTermInput).on('input', function() {
      calculateLoan();
    });

  } catch (err) {
    console.log("An error occurred: " + err.message);
  }
});

</script>

<!-- it used for graphical reperesentation -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- style start here -->
<style>
		.row {
			display: flex;
			flex-wrap: wrap;
		}
		.col {
			flex: 1;
			padding: 10px;
		}
		.col:nth-child(even) {
			background-color: #f1f1f1;
            border-radius:10px;
		}

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 15px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }


            .number::before {
            content: attr(data-value);
            display: none;
            }

            .number::after {
            content: attr(data-value);
            display: inline;
            font-size: 16px;
            font-weight: bold;
            }

            .number::after {
            content: attr(data-value);
            display: inline;
            font-size: 16px;
            font-weight: bold;
            counter-reset: digit;
            }

            .number::after span {
            display: inline-block;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            border-radius: 50%;
            background-color: #ccc;
            margin-right: 5px;
            font-size: 14px;
            font-weight: bold;
            }

            .number::after span::before {
            content: counter(digit);
            counter-increment: digit;
            }


	</style>


    <?php
    return ob_get_clean();
}

add_shortcode('loan_calculator', 'loan_calculator_shortcode');

?>