<template>
   <div>
        <div class="shadow bg-white p-3">
            <h1>Checkout</h1>
              <div class="flex justify-around">
                <div :class="steps==0 ? 'bg-blue-600 inline p-3 transition duration-150 ease-in-out text-white' : 'bg-blue-300 inline p-3 transition duration-150 ease-in-out' ">Billing</div>
                <div :class="steps==1 ? 'bg-blue-600 inline p-3 transition duration-150 ease-in-out text-white' : 'bg-blue-300 inline p-3 transition duration-150 ease-in-out' ">Delivery</div>
                <div :class="steps==2 ? 'bg-blue-600 inline p-3 transition duration-150 ease-in-out text-white' : 'bg-blue-300 inline p-3 transition duration-150 ease-in-out' ">Summary</div>
                <div :class="steps==3 ? 'bg-blue-600 inline p-3 transition duration-150 ease-in-out text-white' : 'bg-blue-300 inline p-3 transition duration-150 ease-in-out' ">Payment</div>
              </div>

            <div v-if="steps==0">
                <h1>Billing Information</h1>
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_first_name']" placeholder="First name">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_last_name']" placeholder="Last name">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_company']" placeholder="Company">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_address_1']" placeholder="Address Line 1">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_address_2']" placeholder="Address Line 2">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_city']" placeholder="City">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_postcode']" placeholder="Post Code">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_country']" placeholder="Country">
                <input type="text" class="block p-2 border-black border-b-2" v-model="billing['billing_state']" placeholder="State">
            </div>

                <div v-if="steps==1">
                <h1>Delivery Information</h1>
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_first_name']" placeholder="First name">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_last_name']" placeholder="Last name">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_company']" placeholder="Company">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_address_1']" placeholder="Address Line 1">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_address_2']" placeholder="Address Line 2">
                <input type="text" class="block p-2 border-black border-b-2"  v-model="delivery['delivery_city']" placeholder="City">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_postcode']" placeholder="Post Code">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_country']" placeholder="Country">
                <input type="text" class="block p-2 border-black border-b-2" v-model="delivery['delivery_state']" placeholder="State">
            </div>

            <div v-if="steps==2">
                <div>
                    <h1>Billing Address</h1>
                    <p class="block">
                      <b>billing_first_name</b>  {{billing['billing_first_name']}}
                    </p>
                    <p class="block">
                        <b>billing_last_name</b> {{billing['billing_last_name']}}
                    </p>
                    <p class="block">
                      <b>billing_company</b>   {{billing['billing_company']}}
                    </p>
                     <p class="block">
                       <b>billing_address_1</b>  {{billing['billing_address_1']}}
                     </p>
                    
                    <p class="block">
                       <b>billing_address_2</b> {{billing['billing_address_2']}}
                    </p>
                    <p>
                      <b>billing_city</b>  {{billing['billing_city']}}
                    </p>
                    <p>
                        <b>billing_postcode</b> {{billing['billing_postcode']}}
                    </p>
                      <p>
                        <b>billing_country</b>  {{billing['billing_country']}}
                      </p>
                    <p>
                      <b>billing_state</b>  {{billing['billing_state']}}
                    </p>
                </div>
                   <div>
                    <h1>Delivery Address</h1>
                    <p class="block">
                      <b>billing_first_name</b>  {{delivery['delivery_first_name']}}
                    </p>
                    <p class="block">
                        <b>billing_last_name</b> {{delivery['delivery_last_name']}}
                    </p>
                    <p class="block">
                      <b>billing_company</b>   {{delivery['delivery_company']}}
                    </p>
                     <p class="block">
                       <b>billing_address_1</b>  {{delivery['delivery_address_1']}}
                     </p>
                    
                    <p class="block">
                       <b>billing_address_2</b> {{delivery['delivery_address_2']}}
                    </p>
                    <p>
                      <b>billing_city</b>  {{delivery['delivery_city']}}
                    </p>
                    <p>
                        <b>billing_postcode</b> {{delivery['delivery_postcode']}}
                    </p>
                      <p>
                        <b>billing_country</b>  {{delivery['delivery_country']}}
                      </p>
                    <p>
                      <b>billing_state</b>  {{delivery['delivery_state']}}
                    </p>
                </div>
                
                <div class="cart">
                    <table>
                        <thead>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Product Code</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Product</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Quantity</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Price</th>
                        </thead>
                        <tbody>
                            <tr v-for="(row,key) in cart" :key="key">
                                <td class="py-4 px-6 border-b border-grey-light">{{row.product_code}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{row.name}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{row.qty}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{row.price}}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-if="steps==3 && successpay==false">
                    <div class="text-center">
                        <h2>You will be charged: {{carttotal}}</h2>
                    <p>Your information is securly processed by our payment provider.</p>
                    </div>
                 <div class="container mx-auto">
                    <div class="flex justify-center">
                        <div class="border p-3 w-1/2 clearfix">
                            <div id="card-element" class="w-full p-1"></div>
                        <div id="card-errors" role="alert"></div>
                        <button @click="pay()" v-if="payinit==false" class="p-2 border bg-blue-300 float-right">Pay</button>
                        </div>
                    </div>
                 </div>
            </div>

            <div v-if="successpay">
                <h1>Payment Successful!</h1>
                <p>Thanks for purchasing from us! You should receive an email within a few minutes to confirm your order.</p>
                <p>Just to confirm, find your details below</p>

                <h2>Billing Address</h2>
                     {{billing['billing_first_name']}} {{billing['billing_last_name']}} {{billing['billing_company']}} {{billing['billing_address_1']}}
                    {{billing['billing_address_2']}} {{billing['billing_city']}} {{billing['billing_postcode']}} {{billing['billing_country']}}
                    {{billing['billing_state']}}

                <h2>Delivery Address</h2>
                    {{delivery['delivery_first_name']}} {{delivery['delivery_last_name']}} {{delivery['delivery_company']}} {{delivery['delivery_address_1']}}
                    {{delivery['delivery_address_2']}} {{delivery['delivery_city']}} {{delivery['delivery_postcode']}} {{delivery['delivery_country']}}
                    {{delivery['delivery_state']}}

                    
                <h2>Items in order</h2>
                <div class="cart">
                    <table>
                        <thead>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Product Code</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Product</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Quantity</th>
                        </thead>
                        <tbody>
                            <tr v-for="(row,key) in cart" :key="key">
                                <td class="py-4 px-6 border-b border-grey-light">{{row.product_code}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{row.name}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{row.qty}}</td>
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
        <div class="clearfix p-2">
           <button class="bg-blue-500 p-2 float-left text-white" @click="stepBackward()" v-show="steps>0">Step Back</button>
           <button  class="bg-blue-500 p-2 float-right text-white" @click="stepForward()" v-show="steps<3">Step Forward</button>
       </div>
        </div>


   </div>
</template>

<script>
export default {
    data : function() {
        return {
            steps : 0,
            successpay: false,
            payinit : false,
            stripe : null,
            card: null,
            elements: null,
            billing  : {
                billing_first_name : '',
                billing_last_name: '',
                billing_company: '',
                billing_address_1: '',
                billing_address_2: '',
                billing_city: '',
                billing_postcode: '',
                billing_country: '',
                billing_state: '',
            },
            delivery : {
                delivery_first_name : '',
                delivery_last_name: '',
                delivery_company: '',
                delivery_address_1: '',
                delivery_address_2: '',
                delivery_city: '',
                delivery_postcode: '',
                delivery_country: '',
                delivery_state: '',
            },
            
        }
    },
    methods : {
        stepForward: function(){
            if(this.steps==2){
                let error = false;
                for(let del in this.delivery){
                    if(this.delivery[del].length>0){
                    }else{
                        error = true
                    }
                }

                for(let bil in this.billing){
                    if(this.billing[bil].length>0){
                    }else{
                    error = true
                    }
                }
                if(error){
                alert("Please complete delivery and billing information");
                }else{
                this.initPayment();

                this.steps++;
                }

            }else {
            this.steps++;

            }
        },
        stepBackward: function(){
            this.steps--;
        },
        initPayment(){
            let self = this;
            setTimeout(function(){
            self.stripe = Stripe(self.stripekey);
            self.elements = self.stripe.elements();
            self.card = self.elements.create("card", {style: {
                  base: {
      iconColor: '#c4f0ff',
      color: '#000',
      fontWeight: 500,
      fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
      fontSize: '16px',
      fontSmoothing: 'antialiased',
      ':-webkit-autofill': {
        color: '#000',
      },
      '::placeholder': {
        color: '#87BBFD',
      },
    },
    invalid: {
      iconColor: '#E3E3E3',
      color: '#E3E3E3',
    },
            }});
            self.card.addEventListener('change', function({error}){
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
            });
            self.card.mount("#card-element");
            })
        },
    pay(){
    var self =this;
    this.payinit = true;
    this.stripe.confirmCardPayment(this.stripeintent, {
    payment_method: {
      card: this.card,
      billing_details: {
        name: this.billing.billing_first_name + " " + this.billing.billing_last_name
      }
    }
  }).then(function(result) {
    if (result.error) {
            this.payinit = false;

                if (result.error) {
            displayError.textContent = result.error.message;
            } else {
                displayError.textContent = '';
            }
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
          axios.post('/handlepayment',{'deliveryaddress' : self.delivery, 'billingaddress': self.billing},{}).then( function(res){
            if(res.status==200 && res.data=="Success"){
                self.successpay= true;
            }
          })
      }
    }
  });
        }
    },
    props : {
        cart : Array,
        stripekey : String,
        carttotal: String,
        stripeintent: String
    }
}
</script>