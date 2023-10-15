<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="my-8 sm:rounded-lg max-w-2xl mx-auto">
                    <form action="{{ isset($course) ? route('course-custom-update', $course->id_course) : route('course-custom-update') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 sm:col-span-1">
                                <label for="id_course" class="block text-sm font-medium text-gray-700">ID Course</label>
                                <input required type="text" id="id_course" name="id_course" value="{{ $course->id_course ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="time_start" class="block text-sm font-medium text-gray-700">Time start</label>
                                <input required type="date" id="time_start" name="time_start" value="{{ $course->time_start ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="name_course" class="block text-sm font-medium text-gray-700">Name Course</label>
                                <input required type="text" id="name_course" name="name_course" value="{{ $course->name_course ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="tuitionFee" class="block text-sm font-medium text-gray-700">Tuition Fee</label>
                                <input required type="text" id="tuitionFee" name="tuitionFee" value="{{ $course->tuitionFee ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div> 
                            <div class="col-span-2 sm:col-span-1">
                                <label for="maxStudents" class="block text-sm font-medium text-gray-700">Max Students</label>
                                <input required type="text" value="15" id="maxStudents" name="maxStudents" value="{{ $course->maxStudents ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="weeks" class="block text-sm font-medium text-gray-700">Number of Weeks</label>
                                <input required type="text" id="weeks" value="10" name="weeks" value="{{ $course->weeks ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div> 
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div class="col-span-3 sm:col-span-1">
                                <label for="day1" class="block text-sm font-medium text-gray-700">Day 1</label>
                                <div class="flex justify-around">
                                    <select required id="day1" name="days[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="day1">
                                        <option value="Monday" {{ $course->days[0] == 'Monday' ? 'selected' : '' }}>Monday</option>
                                        <option value="Tuesday" {{ $course->days[0] == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="Wednesday" {{ $course->days[0] == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="Thursday" {{ $course->days[0] == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                        <option value="Friday" {{ $course->days[0] == 'Friday' ? 'selected' : '' }}>Friday</option>
                                        <option value="Saturday" {{ $course->days[0] == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label for="lesson1" class="block text-sm font-medium text-gray-700">Lesson 1</label>
                                <div class="flex justify-around">
                                    <select required id="lesson1" name="lessons[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="lesson1">
                                        @foreach($lessons as $lesson)
                                            <option value="{{ $lesson->id_lesson }}" {{ $course->lessons[0] == $lesson->id_lesson ? 'selected' : '' }}>{{ $lesson->id_lesson }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label for="room1" class="block text-sm font-medium text-gray-700">Room 1</label>
                                <div class="flex justify-around">
                                    <select required id="room1" name="rooms[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="room1">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id_room }}" {{ $course->rooms[0] == $room->id_room ? 'selected' : '' }}>{{ $room->id_room }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-3 sm:col-span-1">
                                <label for="day2" class="block text-sm font-medium text-gray-700">Day 2</label>
                                <div class="flex justify-around">
                                    <select required id="day2" name="days[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="day2">
                                        <option value="Monday" {{ $course->days[1] == 'Monday' ? 'selected' : '' }}>Monday</option>
                                        <option value="Tuesday" {{ $course->days[1] == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="Wednesday" {{ $course->days[1] == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="Thursday" {{ $course->days[1] == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                        <option value="Friday" {{ $course->days[1] == 'Friday' ? 'selected' : '' }}>Friday</option>
                                        <option value="Saturday" {{ $course->days[1] == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-span-3 sm:col-span-1">
                                <label for="lesson2" class="block text-sm font-medium text-gray-700">Lesson 2</label>
                                <div class="flex justify-around">
                                    <select required id="lesson2" name="lessons[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="lesson2">
                                        @foreach($lessons as $lesson)
                                            <option value="{{ $lesson->id_lesson }}" {{ $course->lessons[1] == $lesson->id_lesson ? 'selected' : '' }}>{{ $lesson->id_lesson }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label for="room2" class="block text-sm font-medium text-gray-700">Room 2</label>
                                <div class="flex justify-around">
                                    <select required id="room2" name="rooms[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="room2">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id_room }}" {{ $course->rooms[1] == $room->id_room ? 'selected' : '' }}>{{ $room->id_room }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-3 sm:col-span-1">
                                <label for="day3" class="block text-sm font-medium text-gray-700">Day 3</label>
                                <div class="flex justify-around">
                                    <select required id="day3" name="days[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="day3">
                                        <option value="Monday" {{ $course->days[2] == 'Monday' ? 'selected' : '' }}>Monday</option>
                                        <option value="Tuesday" {{ $course->days[2] == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="Wednesday" {{ $course->days[2] == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="Thursday" {{ $course->days[2] == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                        <option value="Friday" {{ $course->days[2] == 'Friday' ? 'selected' : '' }}>Friday</option>
                                        <option value="Saturday" {{ $course->days[2] == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-span-3 sm:col-span-1">
                                <label for="lesson3" class="block text-sm font-medium text-gray-700">Lesson 3</label>
                                <div class="flex justify-around">
                                    <select required id="lesson3" name="lessons[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="room3">
                                        @foreach($lessons as $lesson)
                                            <option value="{{ $lesson->id_lesson }}" {{ $course->lessons[2] == $lesson->id_lesson ? 'selected' : '' }}>{{ $lesson->id_lesson }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label for="room3" class="block text-sm font-medium text-gray-700">Room 3</label>
                                <div class="flex justify-around">
                                    <select required id="room3" name="rooms[]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus autocomplete="room3">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id_room }}" {{ $course->rooms[2] == $room->id_room ? 'selected' : '' }}>{{ $room->id_room }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div class="col-span-2 sm:col-span-1"> 
                                <label for="teacher" class="block text-sm font-medium text-gray-700">Teacher:</label>
                                <input type="text" id="teacher" name="teacher" value="{{ $course->teacher ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            
                            <div class="col-span-2 sm:col-span-1">
                                <label for="students_list" class="block text-sm font-medium text-gray-700">Students List:</label>
                                <textarea name="students_list[]" id="students_list" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-center">
                            <x-primary-button type="submit">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>