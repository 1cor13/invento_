

I have passed <br/>
<h1>{{ $myName }}'s Orders</h1>

<br>
<br>
<br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Order</th>
            <th scope="col">Customer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($myVars as $myVar)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                @foreach ($myVar as $item)
                    <td>{{ $item }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
    
</table>
