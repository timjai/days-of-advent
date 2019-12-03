@extends('day', ['day' => 1, 'title' => 'Day 1: The Tyranny of the Rocket Equation'])

@section('quest')
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Part 1
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <article class="day-desc">
                        <p>Santa has become stranded at the edge of the Solar System while delivering presents to other planets! To accurately calculate his position in space, safely align his warp drive, and return to Earth in time to save Christmas, he needs you to bring him
                            <span title="If only you had time to grab an astrolabe.">measurements</span> from
                            <em class="star">fifty stars</em>.</p>
                        <p>Collect stars by solving puzzles. Two puzzles will be made available on each day in the Advent calendar; the second puzzle is unlocked when you complete the first. Each puzzle grants
                            <em class="star">one star</em>. Good luck!</p>
                        <p>The Elves quickly load you into a spacecraft and prepare to launch.</p>
                        <p>At the first Go / No Go poll, every Elf is Go until the Fuel Counter-Upper. They haven't determined the amount of fuel required yet.</p>
                        <p>Fuel required to launch a given <em>module</em> is based on its
                            <em>mass</em>. Specifically, to find the fuel required for a module, take its mass, divide by three, round down, and subtract 2.
                        </p>
                        <p>For example:</p>
                        <ul>
                            <li>For a mass of <code>12</code>, divide by 3 and round down to get
                                <code>4</code>, then subtract 2 to get <code>2</code>.
                            </li>
                            <li>For a mass of <code>14</code>, dividing by 3 and rounding down still yields
                                <code>4</code>, so the fuel required is also <code>2</code>.
                            </li>
                            <li>For a mass of <code>1969</code>, the fuel required is <code>654</code>.</li>
                            <li>For a mass of <code>100756</code>, the fuel required is <code>33583</code>.</li>
                        </ul>
                        <p>The Fuel Counter-Upper needs to know the total fuel requirement. To find it, individually calculate the fuel needed for the mass of each module (your puzzle input), then add together all the fuel values.</p>
                        <p><em>What is the sum of the fuel requirements</em> for all of the modules on your spacecraft?
                        </p>
                    </article>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Part 2
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <article class="day-desc">
                        <p>During the second Go / No Go poll, the Elf in charge of the Rocket Equation Double-Checker stops the launch sequence. Apparently, you forgot to include additional fuel for the fuel you just added.</p>
                        <p>Fuel itself requires fuel just like a module - take its mass, divide by three, round down, and subtract 2. However, that fuel
                            <em>also</em> requires fuel, and
                            <em>that</em> fuel requires fuel, and so on. Any mass that would require
                            <em>negative fuel</em> should instead be treated as if it requires
                            <em>zero fuel</em>; the remaining mass, if any, is instead handled by
                            <em>wishing really hard</em>, which has no mass and is outside the scope of this calculation.
                        </p>
                        <p>So, for each module mass, calculate its fuel and add it to the total. Then, treat the fuel amount you just calculated as the input mass and repeat the process, continuing until a fuel requirement is zero or negative. For example:</p>
                        <ul>
                            <li>A module of mass <code>14</code> requires
                                <code>2</code> fuel. This fuel requires no further fuel (2 divided by 3 and rounded down is
                                <code>0</code>, which would call for a negative fuel), so the total fuel required is still just
                                <code>2</code>.
                            </li>
                            <li>At first, a module of mass <code>1969</code> requires
                                <code>654</code> fuel. Then, this fuel requires
                                <code>216</code> more fuel (<code>654 / 3 - 2</code>). <code>216</code> then requires
                                <code>70</code> more fuel, which requires <code>21</code> fuel, which requires
                                <code>5</code> fuel, which requires no further fuel. So, the total fuel required for a module of mass
                                <code>1969</code> is <code>654 + 216 + 70 + 21 + 5 = 966</code>.
                            </li>
                            <li>The fuel required by a module of mass <code>100756</code> and its fuel is:
                                <code>33583 + 11192 + 3728 + 1240 + 411 + 135 + 43 + 12 + 2 = 50346</code>.
                            </li>
                        </ul>
                        <p>
                            <em>What is the sum of the fuel requirements</em> for all of the modules on your spacecraft when also taking into account the mass of the added fuel? (Calculate the fuel requirements for each module separately, then add them all up at the end.)
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('forms')
    <div class="form-group">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#part1default" aria-expanded="false" aria-controls="part1default">
                Default Input
            </button>
        </p>
        <div class="collapse" id="part1default">
            <div class="card card-body">
                {{ $part1 }}
            </div>
        </div>
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="">Custom Json Input</label>
                <textarea class="form-control" name="customInput" id="" rows="3" placeholder="Replace default input with a custom one here"></textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Calculate Fuel">
            </div>

            @if (!empty($result1))
                <p>Result Part 1: {{ $result1 }}</p>
            @endif

            @if (!empty($result2))
                <p>Result Part 2: {{ $result2 }}</p>
            @endif
        </form>


    </div>
@endsection
