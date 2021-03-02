<template>
  <!-- <jet-authentication-card>

  
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card> -->

  <section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
      <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
        <h1 class="title-font font-medium text-3xl text-gray-900">
          Slow-carb next level shoindcgoitch ethical authentic, poko scenester
        </h1>
        <p class="leading-relaxed mt-4">
          Poke slow-carb mixtape knausgaard, typewriter street art gentrify hammock
          starladder roathse. Craies vegan tousled etsy austin.
        </p>
      </div>
      <div
        class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0"
      >
        <!-- <template #logo>
          <jet-authentication-card-logo />
        </template> -->

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
          <div>
            <jet-label for="name" value="Name" />
            <jet-input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              required
              autofocus
              autocomplete="name"
            />
          </div>

          <div class="mt-4">
            <jet-label for="email" value="Email" />
            <jet-input
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
            />
          </div>

          <div class="mt-4">
            <jet-label for="password" value="Password" />
            <jet-input
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              required
              autocomplete="new-password"
            />
          </div>

          <div class="mt-4">
            <jet-label for="password_confirmation" value="Confirm Password" />
            <jet-input
              id="password_confirmation"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password_confirmation"
              required
              autocomplete="new-password"
            />
          </div>

          <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
            <jet-label for="terms">
              <div class="flex items-center">
                <jet-checkbox name="terms" id="terms" v-model="form.terms" />

                <div class="ml-2">
                  I agree to the
                  <a
                    target="_blank"
                    :href="route('terms.show')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    >Terms of Service</a
                  >
                  and
                  <a
                    target="_blank"
                    :href="route('policy.show')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    >Privacy Policy</a
                  >
                </div>
              </div>
            </jet-label>
          </div>

          <div class="flex items-center justify-end mt-4">
            <inertia-link
              :href="route('login')"
              class="underline text-sm text-gray-600 hover:text-gray-900"
            >
              Already registered?
            </inertia-link>

            <jet-button
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Register
            </jet-button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
