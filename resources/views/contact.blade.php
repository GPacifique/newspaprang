<x-app-layout>
<form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
    @csrf

    <input type="text" name="name"
           placeholder="Your Name"
           class="w-full border p-2 rounded">

    <input type="email" name="email"
           placeholder="Your Email"
           class="w-full border p-2 rounded">

    <textarea name="message"
              placeholder="Your Message"
              class="w-full border p-2 rounded h-32"></textarea>

    <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded">
        Send Message
    </button>
</form>
</x-app-layout>