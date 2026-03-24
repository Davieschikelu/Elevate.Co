<div align="center">
    <h1 style="color: #4f46e5; border-bottom: none;">🚀 Elevate.Co</h1>
    <p><b>A modern, multi-step Resume Builder designed to help professionals craft standout resumes.</b></p>
</div>

---

## 📖 About Elevate

Elevate.Co is a sleek, user-friendly resume generation platform built with the robust Laravel PHP framework. It is designed to take the friction out of resume building by offering a dynamic, guided multi-step wizard. Users can construct complex work histories and educational backgrounds with ease, generating highly tailored resumes based on their selected professional context (e.g., Software Developer, Academic, Marketing).

## ✨ Core Features

* **Authentication & Google OAuth**: Seamless single sign-on experience allowing users to securely log in or register using their Google accounts.
* **Modern Multi-Step Wizard**: The resume creation form is broken down into a beautifully animated 4-step wizard using Alpine.js and Tailwind CSS (Personal Details ➔ Education ➔ Experience ➔ Skills & Extras) to minimize cognitive overload.
* **Dynamic Data Inputs**: Users can add unlimited nested entries for their Work Experiences and Education backgrounds without requiring page reloads.
* **Flexible Data Storage**: Resume content is serialized into a highly flexible JSON schema natively supported by Laravel models, allowing the structure to evolve dynamically.
* **Context-Aware Generation**: Resumes can be tailored to match the specific tone required for different industries.
* **Post-Creation Editing**: Users can easily go back to their dashboard and dynamically edit complex multi-dimensional array structures.

## 🛠️ Technology Stack

* **Backend:** [Laravel](https://laravel.com/) (PHP Framework)
* **Frontend Interactivity:** [Alpine.js](https://alpinejs.dev/)
* **Styling:** [Tailwind CSS](https://tailwindcss.com/)
* **Database:** MySQL (Structured using Eloquent ORM + JSON columns)
* **Authentication Tools:** Laravel Socialite (for Google OAuth)

## ⚙️ How it Works Under the Hood

1. **The Form (Alpine.js View)**: When a user clicks "Create Resume", they navigate through the Alpine-powered wizard (`create.blade.php`). As they click "+ Add Job" or "+ Add Education", Alpine splices new empty objects into the JavaScript state array, rendering new HTML inputs dynamically.
2. **The Controller Submission (`ResumeController.php`)**: When the user hits Submit, Laravel intercepts the request and strictly validates the deeply nested array structures (e.g., `experience.*.title`, `education.*.start_date`) to ensure data integrity.
3. **Database Storage (`Resume` Model)**: The entire validated dataset (Personal Info, Arrays of Jobs, Skills) is combined into a single `$generatedContent` JSON map. The `Resume` Eloquent model automatically casts this Array to JSON and saves it into the `content` database column. This bypasses the need for rigid relational tables for variable data.
4. **Editing Existing Resumes (`edit.blade.php`)**: When editing an existing resume, Laravel parses the JSON from the database and injects it securely into the Alpine.js state (`x-data="{ experiences: {{ json_encode(...) }} }"`), allowing the user to seamlessly resume editing complex dynamic lists exactly as they created them.

## 🚀 Local Installation & Setup

If you wish to run the Elevate platform locally for development, follow these steps:

**1. Clone the repository**
```bash
git clone https://github.com/Davieschikelu/Elevate.Co.git
cd Elevate.Co
```

**2. Install PHP and Node.js Dependencies**
```bash
composer install
npm install
```

**3. Environment Setup**
Duplicate the example environment file and generate your application key:
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure Database & Services**
Open your new `.env` file and configure your local database credentials (e.g. MySQL or SQLite).
You will also need to configure your Google OAuth credentials to enable the login flow:
```env
# Database Config
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=resume_generator
DB_USERNAME=root
DB_PASSWORD=

# Google OAuth Config
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

**5. Run Database Migrations**
```bash
php artisan migrate
```

**6. Start the Development Servers**
You need to run Vite for compiling the Tailwind assets, and Artisan to serve the PHP application. Run these commands in two separate terminal tabs:
```bash
npm run dev
php artisan serve
```

*Your app should now be running locally at `http://127.0.0.1:8000`!*

---

> Built with ❤️ using Laravel & Alpine.js
