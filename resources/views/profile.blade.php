<form method="POST" action="{{ route('career.store') }}">
    @csrf

    <label>CGPA:</label>
    <input type="text" name="cgpa"><br>

    <label>Branch:</label>
    <input type="text" name="branch"><br>

    <label>Education Level:</label>
    <input type="text" name="education_level"><br>

    <label>Skills (comma separated):</label>
    <input type="text" name="skills"><br>

    <label>Interests (comma separated):</label>
    <input type="text" name="interests"><br>

    <button type="submit">Save Profile</button>
</form>